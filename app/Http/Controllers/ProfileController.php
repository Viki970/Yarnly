<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\NotificationPreferenceService;
use App\Services\PrivacyPreferenceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the Instagram-style profile page.
     */
    public function show(Request $request): View
    {
        /** @var User $user */
        $user = $request->user();

        $postsCount     = $user->posts()->count();
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();

        // Posts tab – user's own models
        $posts = $user->posts()
            ->with('images')
            ->withCount('likes')
            ->latest()
            ->get();

        // Saved tab – posts the user has bookmarked
        $savedPosts = $user->favoritedPosts()
            ->with('images')
            ->withCount('likes')
            ->latest('post_favorites.created_at')
            ->get();

        // Liked tab – posts the user has liked
        $likedPosts = $user->likedPosts()
            ->with('images')
            ->withCount('likes')
            ->latest('post_likes.created_at')
            ->get();

        // Patterns tab – user's own uploaded patterns
        $patterns = \App\Models\Pattern::where('user_id', $user->id)
            ->latest()
            ->get();

        // Collections tab – user's own pattern collections
        $collections = $user->collections()
            ->with(['patterns' => fn($q) => $q->whereNotNull('image_path')])
            ->withCount('patterns')
            ->latest()
            ->get();

        // Post collections – saved-post bookmark groups with cover images
        $postCollections = $user->postCollections()
            ->with(['posts' => fn($q) => $q->with('images')->latest('post_collection_post.created_at')])
            ->withCount('posts')
            ->latest()
            ->get();

        // Saved tab – favorited patterns
        $favoritePatterns = $user->favoritePatterns()->latest('user_favorites.created_at')->get();

        // Saved tab – favorited pattern collections
        $favoriteCollections = $user->favoriteCollections()
            ->with(['patterns' => fn($q) => $q->whereNotNull('image_path')])
            ->withCount('patterns')
            ->latest('collection_favorites.created_at')
            ->get();

        // Which post collections each saved post belongs to (for the picker modal)
        $postCollectionMemberships = [];
        if ($postCollections->isNotEmpty() && $savedPosts->isNotEmpty()) {
            $postCollectionMemberships = \Illuminate\Support\Facades\DB::table('post_collection_post')
                ->whereIn('post_collection_id', $postCollections->pluck('id'))
                ->whereIn('post_id', $savedPosts->pluck('id'))
                ->get(['post_collection_id', 'post_id'])
                ->groupBy('post_id')
                ->map(fn($rows) => $rows->pluck('post_collection_id')->all())
                ->all();
        }

        return view('profile.myprofile.show', compact(
            'user',
            'postsCount',
            'followersCount',
            'followingCount',
            'posts',
            'savedPosts',
            'likedPosts',
            'patterns',
            'collections',
            'postCollections',
            'postCollectionMemberships',
            'favoritePatterns',
            'favoriteCollections'
        ));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.myprofile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        if ($request->hasFile('profile_picture')) {
            // Delete old picture if present
            if ($user->profile_picture) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_picture);
            }
            $data['profile_picture'] = $request->file('profile_picture')->store('profile-pictures', 'public');
        } else {
            unset($data['profile_picture']);
        }

        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($request->input('_from') === 'settings') {
            return Redirect::route('profile.settings', ['tab' => 'password']);
        }

        return Redirect::route('profile.show');
    }

    /**
     * Display the account settings page.
     */
    public function settings(Request $request): View
    {
        /** @var User $user */
        $user = $request->user();
        $notificationPrefs = app(NotificationPreferenceService::class)->get($user);
        $privacyPrefs = app(PrivacyPreferenceService::class)->get($user);

        return view('profile.settings', compact('user', 'notificationPrefs', 'privacyPrefs'));
    }

    /**
     * Save privacy preferences.
     */
    public function savePrivacyPreferences(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        app(PrivacyPreferenceService::class)->save($user->id, $request->all());

        return Redirect::route('profile.settings', ['tab' => 'privacy'])
            ->with('privacy_prefs_saved', true);
    }

    /**
     * Save notification preferences.
     */
    public function saveNotificationPreferences(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        app(NotificationPreferenceService::class)->save($user->id, $request->all());

        return Redirect::route('profile.settings', ['tab' => 'notifications'])
            ->with('notification_prefs_saved', true);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Display another user's public profile.
     */
    public function showUser(User $user): View|RedirectResponse
    {
        // Redirect to own profile if viewing self
        if (Auth::check() && Auth::id() === $user->id) {
            return Redirect::route('profile.show');
        }

        /** @var User|null $authUser */
        $authUser    = Auth::user();
        $isFollowing = $authUser ? $authUser->isFollowing($user) : false;

        $postsCount     = $user->posts()->count();
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();

        $posts = $user->posts()
            ->with('images')
            ->withCount('likes')
            ->latest()
            ->get();

        $patterns = \App\Models\Pattern::where('user_id', $user->id)
            ->latest()
            ->get();

        $privacyService          = app(PrivacyPreferenceService::class);
        $canShowLikedPosts       = $privacyService->check($user, 'show_liked_posts');
        $canShowSavedPosts       = $privacyService->check($user, 'show_saved_posts');
        $canShowSavedPatterns    = $privacyService->check($user, 'show_saved_patterns');
        $canShowSavedCollections = $privacyService->check($user, 'show_saved_collections');
        $hasSavedTab             = $canShowSavedPosts || $canShowSavedPatterns || $canShowSavedCollections;

        // Standalone Collections tab is always visible (shows user's own public collections)
        $canShowCollections = true;

        $collections = $canShowCollections
            ? $user->collections()
                ->where('is_public', true)
                ->with(['patterns' => fn($q) => $q->whereNotNull('image_path')])
                ->withCount('patterns')
                ->latest()
                ->get()
            : collect();

        $likedPosts = $canShowLikedPosts
            ? $user->likedPosts()
                ->with(['images', 'user'])
                ->withCount('likes')
                ->latest('post_likes.created_at')
                ->get()
            : collect();

        $savedPosts = $canShowSavedPosts
            ? $user->favoritedPosts()
                ->with(['images', 'user'])
                ->withCount('likes')
                ->latest('post_favorites.created_at')
                ->get()
            : collect();

        $favoritePatterns = $canShowSavedPatterns
            ? $user->favoritePatterns()->latest('user_favorites.created_at')->get()
            : collect();

        $favoriteCollections = $canShowSavedCollections
            ? $user->favoriteCollections()
                ->with(['patterns' => fn($q) => $q->whereNotNull('image_path')])
                ->withCount('patterns')
                ->latest('collection_favorites.created_at')
                ->get()
            : collect();

        return view('profile.user.show', compact(
            'user',
            'authUser',
            'isFollowing',
            'postsCount',
            'followersCount',
            'followingCount',
            'posts',
            'patterns',
            'collections',
            'canShowCollections',
            'canShowLikedPosts',
            'canShowSavedPosts',
            'canShowSavedPatterns',
            'canShowSavedCollections',
            'hasSavedTab',
            'likedPosts',
            'savedPosts',
            'favoritePatterns',
            'favoriteCollections',
        ));
    }
}
