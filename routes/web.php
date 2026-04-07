<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $stats = [
        'patterns' => \App\Models\Pattern::count(),
        'users'    => \App\Models\User::count(),
        'posts'    => \App\Models\Post::count(),
    ];
    return view('homepage.home', compact('stats'));
})->name('home');

Route::get('/search/users', [\App\Http\Controllers\SearchController::class, 'users'])->name('search.users');

Route::get('/patterns/crochet', [\App\Http\Controllers\PatternController::class, 'crochet'])->name('patterns.crochet');
Route::get('/patterns/crochet/{category}', [\App\Http\Controllers\PatternController::class, 'crochetByCategory'])->name('patterns.crochet.category');
Route::get('/patterns/knitting', [\App\Http\Controllers\PatternController::class, 'knitting'])->name('patterns.knitting');
Route::get('/patterns/knitting/{category}', [\App\Http\Controllers\PatternController::class, 'knittingByCategory'])->name('patterns.knitting.category');
Route::get('/patterns/embroidery', [\App\Http\Controllers\PatternController::class, 'embroidery'])->name('patterns.embroidery');
Route::get('/patterns/embroidery/{category}', [\App\Http\Controllers\PatternController::class, 'embroideryByCategory'])->name('patterns.embroidery.category');
Route::get('/models/gallery', [\App\Http\Controllers\PatternController::class, 'gallery'])->name('models.gallery');
Route::get('/patterns/{pattern}/view', [\App\Http\Controllers\PatternController::class, 'view'])->name('patterns.view');
Route::get('/patterns/{pattern}/download', [\App\Http\Controllers\PatternController::class, 'download'])->name('patterns.download');

Route::get('/dashboard', function () {
    /** @var \App\Models\User $user */
    $user = \Illuminate\Support\Facades\Auth::user();

    $now     = now();
    $postIds = $user->posts()->pluck('id');
    $weekStart = now()->startOfWeek();

    $likesThisWeek     = \App\Models\PostLike::whereIn('post_id', $postIds)->where('created_at', '>=', $weekStart)->count();
    $commentsThisWeek  = \App\Models\PostComment::whereIn('post_id', $postIds)->where('created_at', '>=', $weekStart)->count();
    $followersThisWeek = \Illuminate\Support\Facades\DB::table('follows')->where('following_id', $user->id)->where('created_at', '>=', $weekStart)->count();

    return view('dashboard', [
        'patternsCount'    => $user->patterns()->count(),
        'postsCount'       => $user->posts()->count(),
        'followersCount'   => $user->followers()->count(),
        'followingCount'   => $user->following()->count(),
        'recentPatterns'   => $user->patterns()->latest()->take(5)->get(),
        'recentPosts'      => $user->posts()->with('images')->latest()->take(4)->get(),
        // activity stats
        'likesReceived'    => \App\Models\PostLike::whereIn('post_id', $postIds)->count(),
        'commentsReceived' => \App\Models\PostComment::whereIn('post_id', $postIds)->count(),
        'commentsGiven'    => $user->postComments()->count(),
        'patternsSaved'    => \App\Models\PostFavorite::whereIn('post_id', $postIds)->count()
                             + \Illuminate\Support\Facades\DB::table('user_favorites')
                                   ->join('patterns', 'user_favorites.pattern_id', '=', 'patterns.id')
                                   ->where('patterns.user_id', $user->id)
                                   ->count(),
        'patternsThisMonth'=> $user->patterns()->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count(),
        'postsThisMonth'   => $user->posts()->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count(),
        // this week
        'likesThisWeek'     => $likesThisWeek,
        'commentsThisWeek'  => $commentsThisWeek,
        'followersThisWeek' => $followersThisWeek,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    $now = now();

    $stats = [
        'total_users'          => \App\Models\User::count(),
        'new_users_month'      => \App\Models\User::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count(),
        'new_users_today'      => \App\Models\User::whereDate('created_at', today())->count(),
        'admin_count'          => \App\Models\User::where('role', 'admin')->count(),

        'total_patterns'       => \App\Models\Pattern::count(),
        'new_patterns_month'   => \App\Models\Pattern::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count(),
        'patterns_by_type'     => \App\Models\Pattern::selectRaw('category, count(*) as total')
                                      ->groupBy('category')
                                      ->pluck('total', 'category')
                                      ->toArray(),

        'total_posts'          => \App\Models\Post::count(),
        'new_posts_month'      => \App\Models\Post::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count(),
        'posts_by_craft'       => \App\Models\Post::selectRaw('craft_type, count(*) as total')
                                      ->groupBy('craft_type')
                                      ->pluck('total', 'craft_type')
                                      ->toArray(),

        'total_collections'    => \App\Models\Collection::count(),
        'new_collections_month'=> \App\Models\Collection::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count(),

        'total_likes'          => \App\Models\PostLike::count(),
        'total_comments'       => \App\Models\PostComment::count(),
    ];

    $recentUsers = \App\Models\User::withCount('patterns')
        ->latest()
        ->take(10)
        ->get();

    $recentPatterns = \App\Models\Pattern::with('user')
        ->latest()
        ->take(15)
        ->get();

    return view('adminPanel.dashboard', compact('stats', 'recentUsers', 'recentPatterns'));
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/users', function () {
        $query = \App\Models\User::withCount(['patterns', 'posts']);

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($role = request('role')) {
            $query->where('role', $role);
        }

        match (request('sort', 'newest')) {
            'oldest'   => $query->oldest(),
            'name'     => $query->orderBy('name'),
            'patterns' => $query->orderByDesc('patterns_count'),
            'posts'    => $query->orderByDesc('posts_count'),
            default    => $query->latest(),
        };

        return view('adminPanel.users', [
            'users' => $query->paginate(20),
            'total' => \App\Models\User::count(),
        ]);
    })->name('admin.users');

    Route::patch('/admin/users/{user}/toggle-role', function (\App\Models\User $user) {
        if ($user->id === \Illuminate\Support\Facades\Auth::id()) {
            abort(403, 'Cannot change your own role.');
        }
        $user->update(['role' => $user->role === 'admin' ? 'user' : 'admin']);
        return back()->with('status', "Role updated for {$user->name}.");
    })->name('admin.users.toggle-role');

    Route::delete('/admin/users/{user}', function (\App\Models\User $user) {
        if ($user->id === \Illuminate\Support\Facades\Auth::id()) {
            abort(403, 'Cannot delete yourself.');
        }
        $user->delete();
        return back()->with('status', "{$user->name} has been deleted.");
    })->name('admin.users.delete');

    // Admin - Posts Management
    Route::get('/admin/posts', function () {
        $query = \App\Models\Post::with('user')->withCount(['likes', 'comments']);

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        if ($craft = request('craft_type')) {
            $query->where('craft_type', $craft);
        }

        match (request('sort', 'newest')) {
            'oldest' => $query->oldest(),
            'likes'  => $query->orderByDesc('likes_count'),
            'comments' => $query->orderByDesc('comments_count'),
            default  => $query->latest(),
        };

        return view('adminPanel.posts', [
            'posts' => $query->paginate(20),
            'total' => \App\Models\Post::count(),
        ]);
    })->name('admin.posts');

    // Admin - Patterns Management
    Route::get('/admin/patterns', function () {
        $query = \App\Models\Pattern::with('user');

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        if ($craftType = request('craft_type')) {
            $query->where('craft_type', $craftType);
        }

        if ($difficulty = request('difficulty')) {
            $query->where('difficulty', $difficulty);
        }

        match (request('sort', 'newest')) {
            'oldest' => $query->oldest(),
            'title'  => $query->orderBy('title'),
            'saved'  => $query->orderByDesc('makers_saved'),
            default  => $query->latest(),
        };

        return view('adminPanel.patterns', [
            'patterns' => $query->paginate(20),
            'total' => \App\Models\Pattern::count(),
        ]);
    })->name('admin.patterns');

    // Admin - Comments Management
    Route::get('/admin/comments', function () {
        $query = \App\Models\PostComment::with(['user', 'post']);

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('body', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        match (request('sort', 'newest')) {
            'oldest' => $query->oldest(),
            default  => $query->latest(),
        };

        return view('adminPanel.comments', [
            'comments' => $query->paginate(20),
            'total' => \App\Models\PostComment::count(),
        ]);
    })->name('admin.comments');
});

Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::post('/settings/notifications', [ProfileController::class, 'saveNotificationPreferences'])->name('profile.notifications.save');
    Route::post('/settings/privacy',       [ProfileController::class, 'savePrivacyPreferences'])->name('profile.privacy.save');
    Route::post('/settings/language',      [ProfileController::class, 'saveLanguage'])->name('profile.language.save');
    Route::post('/settings/theme',         [ProfileController::class, 'saveTheme'])->name('profile.theme.save');
    
    // Pattern creation routes
    Route::get('/patterns/create', [\App\Http\Controllers\PatternController::class, 'create'])->name('patterns.create');
    Route::post('/patterns/store', [\App\Http\Controllers\PatternController::class, 'store'])->name('patterns.store');
    Route::get('/my-patterns', [\App\Http\Controllers\PatternController::class, 'myPatterns'])->name('my-patterns');
    Route::delete('/patterns/{pattern}', [\App\Http\Controllers\PatternController::class, 'destroy'])->name('patterns.destroy');
    
    // Collections routes
    Route::get('/my-collections', [\App\Http\Controllers\CollectionController::class, 'myCollections'])->name('my-collections');
    Route::get('/collections/select-patterns', [\App\Http\Controllers\CollectionController::class, 'selectPatterns'])->name('collections.select-patterns');
    Route::get('/collections/create', [\App\Http\Controllers\CollectionController::class, 'create'])->name('collections.create');
    Route::post('/collections/store', [\App\Http\Controllers\CollectionController::class, 'store'])->name('collections.store');
    Route::post('/collections/{collection}/add-patterns', [\App\Http\Controllers\CollectionController::class, 'addPatternsToExisting'])->name('collections.add-patterns');
    Route::get('/collections/{collection}', [\App\Http\Controllers\CollectionController::class, 'show'])->name('collections.show');
    Route::get('/collections/{collection}/edit', [\App\Http\Controllers\CollectionController::class, 'edit'])->name('collections.edit');
    Route::put('/collections/{collection}', [\App\Http\Controllers\CollectionController::class, 'update'])->name('collections.update');
    Route::delete('/collections/{collection}/remove-cover', [\App\Http\Controllers\CollectionController::class, 'removeCover'])->name('collections.remove-cover');
    Route::get('/collections/{collection}/edit-patterns', [\App\Http\Controllers\CollectionController::class, 'editPatterns'])->name('collections.edit-patterns');
    Route::post('/collections/{collection}/update-patterns', [\App\Http\Controllers\CollectionController::class, 'updatePatterns'])->name('collections.update-patterns');
    Route::get('/collections/{collection}/download-all', [\App\Http\Controllers\CollectionController::class, 'downloadAll'])->name('collections.downloadAll');
    Route::delete('/collections/{collection}', [\App\Http\Controllers\CollectionController::class, 'destroy'])->name('collections.destroy');
    
    // Post Collections (saved-post bookmarks organized into named collections)
    Route::get('/saved-collections',                                          [\App\Http\Controllers\PostCollectionController::class, 'index'])     ->name('post-collections.index');
    Route::post('/saved-collections',                                         [\App\Http\Controllers\PostCollectionController::class, 'store'])     ->name('post-collections.store');
    Route::get('/saved-collections/all',                                      [\App\Http\Controllers\PostCollectionController::class, 'allPosts'])  ->name('post-collections.all');
    Route::get('/saved-collections/{postCollection}',                         [\App\Http\Controllers\PostCollectionController::class, 'show'])      ->name('post-collections.show');
    Route::delete('/saved-collections/{postCollection}',                      [\App\Http\Controllers\PostCollectionController::class, 'destroy'])   ->name('post-collections.destroy');
    Route::patch('/saved-collections/{postCollection}/rename',                [\App\Http\Controllers\PostCollectionController::class, 'rename'])    ->name('post-collections.rename');
    Route::post('/saved-collections/{postCollection}/posts',                  [\App\Http\Controllers\PostCollectionController::class, 'addPost'])   ->name('post-collections.add-post');
    Route::delete('/saved-collections/{postCollection}/posts',                [\App\Http\Controllers\PostCollectionController::class, 'removePost'])->name('post-collections.remove-post');

    // Favorites routes
    Route::post('/patterns/{pattern}/toggle-favorite', [\App\Http\Controllers\PatternController::class, 'toggleFavorite'])->name('patterns.toggle-favorite');
    Route::post('/collections/{collection}/toggle-favorite', [\App\Http\Controllers\CollectionController::class, 'toggleFavorite'])->name('collections.toggle-favorite');
    Route::get('/favorites', [\App\Http\Controllers\PatternController::class, 'favorites'])->name('patterns.favorites');
});

// ─── Posts ─────────────────────────────────────────────────────────────────
// Public feed & single post view
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Specific named routes MUST be declared before the {post} wildcard
Route::middleware('auth')->group(function () {
    Route::get('/posts/create',    [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/liked',     [PostController::class, 'liked'])->name('posts.liked');
    Route::get('/posts/favorited', [PostController::class, 'favorited'])->name('posts.favorited');
    Route::post('/posts',          [PostController::class, 'store'])->name('posts.store');
});

// Wildcard show route after specific routes
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Comments (GET is public; POST requires auth)
Route::get('/posts/{post}/comments', [PostController::class, 'comments'])->name('posts.comments');

// Auth-required actions on a post
Route::middleware('auth')->group(function () {
    Route::delete('/posts/{post}',          [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{post}/like',       [PostController::class, 'like'])->name('posts.like');
    Route::delete('/posts/{post}/like',     [PostController::class, 'unlike'])->name('posts.unlike');
    Route::post('/posts/{post}/favorite',   [PostController::class, 'favorite'])->name('posts.favorite');
    Route::delete('/posts/{post}/favorite', [PostController::class, 'unfavorite'])->name('posts.unfavorite');
    Route::post('/posts/{post}/comments',   [PostController::class, 'storeComment'])->name('posts.comments.store');
    Route::delete('/comments/{comment}',    [PostController::class, 'destroyComment'])->name('comments.destroy');
});

// ─── Public User Profiles ────────────────────────────────────────────────────
Route::get('/users/{user}', [ProfileController::class, 'showUser'])->name('users.show');

// ─── Follow ──────────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::post('/users/{user}/follow',   [FollowController::class, 'follow'])  ->name('users.follow');
    Route::delete('/users/{user}/follow', [FollowController::class, 'unfollow'])->name('users.unfollow');
});

// ─── Notifications ──────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.markRead');
    Route::post('/notifications/mark-all-read', function () {
        /** @var \App\Models\User $authUser */
        $authUser = \Illuminate\Support\Facades\Auth::user();
        $authUser->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.markAllRead');
});

require __DIR__.'/auth.php';
