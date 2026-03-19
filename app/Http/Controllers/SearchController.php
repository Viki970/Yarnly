<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PrivacyPreferenceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function users(Request $request): JsonResponse
    {
        $q = trim($request->input('q', ''));

        if (strlen($q) < 1) {
            return response()->json([]);
        }

        $service = app(PrivacyPreferenceService::class);

        $users = User::where(function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%')
                      ->orWhere('username', 'like', '%' . $q . '%');
            })
            ->when(Auth::check(), fn ($query) => $query->where('id', '!=', Auth::id()))
            ->limit(15)
            ->get();

        $results = $users
            ->filter(fn ($user) => $service->check($user, 'searchable_profile'))
            ->map(fn ($user) => [
                'name'            => $user->name,
                'username'        => $user->username,
                'profile_picture' => $user->hasProfileImage()
                    ? asset('storage/' . $user->profile_picture)
                    : null,
                'avatar_color'    => $user->avatarColor(),
                'initials'        => $user->initials(),
                'profile_url'     => route('users.show', $user),
            ])
            ->values();

        return response()->json($results);
    }
}
