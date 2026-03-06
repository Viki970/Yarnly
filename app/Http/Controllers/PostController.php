<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostLike;
use App\Models\PostFavorite;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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

        return redirect()->route('models.gallery')
                         ->with('success', 'Post created successfully!');
    }

    public function show(Post $post): RedirectResponse
    {
        return redirect()->route('models.gallery');
    }

    public function destroy(Post $post): RedirectResponse
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

        return redirect()->route('models.gallery')
                         ->with('success', 'Post deleted.');
    }

    // ─── LIKES ───────────────────────────────────────────────────────────────

    public function like(Post $post)
    {
        /** @var User $user */
        $user = Auth::user();
        PostLike::firstOrCreate(['user_id' => $user->id, 'post_id' => $post->id]);
        $count = $post->likes()->count();
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
