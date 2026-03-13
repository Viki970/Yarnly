<?php

namespace App\Http\Controllers;

use App\Models\PostCollection;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCollectionController extends Controller
{
    /**
     * Return all post collections for the authenticated user (JSON, used by the picker modal).
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $collections = $user->postCollections()
            ->with(['posts' => fn($q) => $q->with('images')->latest('post_collection_post.created_at')])
            ->withCount('posts')
            ->latest()
            ->get()
            ->map(function ($col) {
                $coverImages = $col->posts
                    ->map(fn($p) => $p->images->first())
                    ->filter()
                    ->take(4)
                    ->values();

                return [
                    'id'             => $col->id,
                    'name'           => $col->name,
                    'posts_count'    => $col->posts_count,
                    'cover_images'   => $coverImages->map(fn($img) => asset('storage/' . $img->image_path))->values(),
                ];
            });

        return response()->json(['collections' => $collections]);
    }

    /**
     * Create a new post collection.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);

        $collection = PostCollection::create([
            'user_id' => Auth::id(),
            'name'    => $request->name,
        ]);

        // Optionally add a post right away
        if ($request->filled('post_id')) {
            $post = Post::findOrFail($request->post_id);
            /** @var \App\Models\User $user */
            $user = Auth::user();
            if ($user->hasFavoritedPost($post)) {
                $collection->posts()->attach($post->id);
            }
        }

        $coverImages = $collection->posts()
            ->with('images')
            ->get()
            ->map(fn($p) => $p->images->first())
            ->filter()
            ->take(4)
            ->values()
            ->map(fn($img) => asset('storage/' . $img->image_path));

        return response()->json([
            'success'    => true,
            'collection' => [
                'id'           => $collection->id,
                'name'         => $collection->name,
                'posts_count'  => $collection->posts()->count(),
                'cover_images' => $coverImages,
            ],
        ]);
    }

    /**
     * Show the posts inside a single post collection.
     */
    public function show(PostCollection $postCollection)
    {
        if ($postCollection->user_id !== Auth::id()) {
            abort(403);
        }

        $posts = $postCollection->posts()
            ->with(['images', 'user'])
            ->withCount('likes')
            ->latest('post_collection_post.created_at')
            ->get();

        return view('profile.saved-collections.show', compact('postCollection', 'posts'));
    }

    /**
     * Show all saved posts (the virtual "All Posts" collection).
     */
    public function allPosts()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $posts = $user->favoritedPosts()
            ->with(['images', 'user'])
            ->withCount('likes')
            ->latest('post_favorites.created_at')
            ->get();

        $postCollections = $user->postCollections()
            ->withCount('posts')
            ->latest()
            ->get();

        $postCollections->load('posts');

        $postCollectionMemberships = [];
        foreach ($postCollections as $col) {
            foreach ($col->posts as $p) {
                $postCollectionMemberships[$p->id][] = $col->id;
            }
        }

        return view('profile.saved-collections.all', compact('posts', 'postCollections', 'postCollectionMemberships'));
    }

    /**
     * Rename a post collection.
     */
    public function rename(Request $request, PostCollection $postCollection)
    {
        if ($postCollection->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate(['name' => 'required|string|max:100']);
        $postCollection->update(['name' => $request->name]);

        return response()->json(['success' => true]);
    }

    /**
     * Add a saved post to a collection.
     */
    public function addPost(Request $request, PostCollection $postCollection)
    {
        if ($postCollection->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate(['post_id' => 'required|exists:posts,id']);

        $post = Post::findOrFail($request->post_id);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->hasFavoritedPost($post)) {
            return response()->json(['success' => false, 'message' => 'Save the post first before adding it to a collection.'], 422);
        }

        $postCollection->posts()->syncWithoutDetaching([$request->post_id]);

        return response()->json(['success' => true]);
    }

    /**
     * Remove a post from a collection.
     */
    public function removePost(Request $request, PostCollection $postCollection)
    {
        if ($postCollection->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate(['post_id' => 'required|exists:posts,id']);
        $postCollection->posts()->detach($request->post_id);

        return response()->json(['success' => true]);
    }

    /**
     * Delete a post collection (posts are NOT deleted, just the grouping).
     */
    public function destroy(PostCollection $postCollection)
    {
        if ($postCollection->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $postCollection->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('profile.show');
    }
}
