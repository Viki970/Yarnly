<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\NotificationPreferenceService;
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

        return view('profile.show', compact(
            'user',
            'postsCount',
            'followersCount',
            'followingCount',
            'posts',
            'savedPosts',
            'likedPosts'
        ));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
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

        return view('profile.settings', compact('user', 'notificationPrefs'));
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
}
