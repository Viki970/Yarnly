<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewFollowNotification;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Follow the given user.
     */
    public function follow(User $user)
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        if ($authUser->id === $user->id) {
            return request()->expectsJson()
                ? response()->json(['error' => 'You cannot follow yourself.'], 422)
                : back();
        }

        $authUser->follow($user);

        // Notify the followed user
        $user->notify(new NewFollowNotification($authUser));

        return request()->expectsJson()
            ? response()->json(['following' => true, 'followers_count' => $user->followers()->count()])
            : back();
    }

    /**
     * Unfollow the given user.
     */
    public function unfollow(User $user)
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        $authUser->unfollow($user);

        return request()->expectsJson()
            ? response()->json(['following' => false, 'followers_count' => $user->followers()->count()])
            : back();
    }
}
