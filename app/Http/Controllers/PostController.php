<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostImage;
use App\Models\PostLike;
use App\Models\PostFavorite;
use App\Models\User;
use App\Notifications\NewLikeNotification;
use App\Notifications\NewCommentNotification;
use App\Notifications\NewPostFromFollowedNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    // ─── CRUD ────────────────────────────────────────────────────────────────

    public function index(): RedirectResponse
    {
        return redirect()->route('models.gallery');
    }

    public function create(): View
    {
        return view('gallery.posts.create');
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $post = Post::create([
            'user_id'    => $user->id,
            'description'=> $request->description,
            'craft_type' => $request->craft_type,
            'tags'       => $request->tags,
        ]);

        foreach ($request->file('images') as $index => $image) {
            $path = $image->store('posts', 'public');

            PostImage::create([
                'post_id'    => $post->id,
                'image_path' => $path,
                'order'      => $index,
            ]);
        }

        // Notify all followers of the poster about the new post
        foreach ($user->followers as $follower) {
            $follower->notify(new NewPostFromFollowedNotification($user, $post));
        }

        return redirect()->route('models.gallery')
                         ->with('success', 'Post created successfully!');
    }

    public function show(Post $post): View
    {
        $post->load(['user', 'images']);

        $liked     = Auth::check() && $post->isLikedBy(Auth::user());
        $favorited = Auth::check() && $post->isFavoritedBy(Auth::user());

        return view('gallery.posts.show', compact('post', 'liked', 'favorited'));
    }

    public function comments(Post $post): JsonResponse
    {
        $comments = $post->comments()
            ->with('user')
            ->get()
            ->map(fn($c) => [
                'id'         => $c->id,
                'body'       => $c->body,
                'author'     => $c->user->name,
                'initials'   => strtoupper(substr($c->user->name, 0, 1)),
                'avatar'     => $c->user->profile_picture
                                    ? asset('storage/' . $c->user->profile_picture)
                                    : null,
                'created_at' => $c->created_at->diffForHumans(),
            ]);

        return response()->json(['comments' => $comments]);
    }

    public function storeComment(Request $request, Post $post): JsonResponse
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:500'],
        ]);

        /** @var User $user */
        $user    = Auth::user();
        $comment = PostComment::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'body'    => $validated['body'],
        ]);

        $comment->load('user');

        // Notify post owner (not if they comment on their own post)
        if ($post->user_id !== $user->id) {
            $post->user->notify(new NewCommentNotification($user, $post, $validated['body']));
        }

        return response()->json([
            'comment' => [
                'id'         => $comment->id,
                'body'       => $comment->body,
                'author'     => $comment->user->name,
                'initials'   => strtoupper(substr($comment->user->name, 0, 1)),
                'avatar'     => $comment->user->profile_picture
                                    ? asset('storage/' . $comment->user->profile_picture)
                                    : null,
                'created_at' => $comment->created_at->diffForHumans(),
            ],
        ], 201);
    }

    public function destroy(Post $post): RedirectResponse|JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($post->user_id !== $user->id) {
            abort(403);
        }

        // Delete all stored images from disk
        foreach ($post->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $post->delete();

        if (request()->wantsJson()) {
            return response()->json(['deleted' => true]);
        }

        return redirect()->route('models.gallery')
                         ->with('success', 'Post deleted.');
    }

    // ─── LIKES ───────────────────────────────────────────────────────────────

    public function like(Post $post)
    {
        /** @var User $user */
        $user = Auth::user();
        $alreadyLiked = PostLike::where('user_id', $user->id)->where('post_id', $post->id)->exists();
        PostLike::firstOrCreate(['user_id' => $user->id, 'post_id' => $post->id]);
        $count = $post->likes()->count();

        // Notify post owner (only on first like, not if they like their own post)
        if (!$alreadyLiked && $post->user_id !== $user->id) {
            $post->user->notify(new NewLikeNotification($user, $post));
        }

        return request()->expectsJson()
            ? response()->json(['liked' => true, 'count' => $count])
            : back();
    }

    public function unlike(Post $post)
    {
        /** @var User $user */
        $user = Auth::user();
        PostLike::where('user_id', $user->id)->where('post_id', $post->id)->delete();
        $count = $post->likes()->count();
        return request()->expectsJson()
            ? response()->json(['liked' => false, 'count' => $count])
            : back();
    }

    // ─── FAVORITES ───────────────────────────────────────────────────────────

    public function favorite(Post $post)
    {
        /** @var User $user */
        $user = Auth::user();
        PostFavorite::firstOrCreate(['user_id' => $user->id, 'post_id' => $post->id]);
        return request()->expectsJson()
            ? response()->json(['favorited' => true])
            : back();
    }

    public function unfavorite(Post $post)
    {
        /** @var User $user */
        $user = Auth::user();
        PostFavorite::where('user_id', $user->id)->where('post_id', $post->id)->delete();
        return request()->expectsJson()
            ? response()->json(['favorited' => false])
            : back();
    }

    // ─── LISTING PAGES ───────────────────────────────────────────────────────

    public function liked(): View
    {
        abort_unless(Auth::check(), 403);

        /** @var User $user */
        $user  = Auth::user();
        $posts = $user->likedPosts()
                      ->with(['user', 'images'])
                      ->withCount('likes')
                      ->latest('post_likes.created_at')
                      ->paginate(15);

        return view('profile.liked', compact('posts'));
    }

    public function favorited(): View
    {
        abort_unless(Auth::check(), 403);

        /** @var User $user */
        $user  = Auth::user();
        $posts = $user->favoritedPosts()
                      ->with(['user', 'images'])
                      ->withCount('likes')
                      ->latest('post_favorites.created_at')
                      ->paginate(15);

        return view('profile.favorited', compact('posts'));
    }
}
