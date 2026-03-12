<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage.home');
})->name('home');

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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::post('/settings/notifications', [ProfileController::class, 'saveNotificationPreferences'])->name('profile.notifications.save');
    
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
});

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
