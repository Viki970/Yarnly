<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class PrivacyPreferenceService
{
    public const DEFAULTS = [
        'searchable_profile'    => true,
        'show_liked_posts'      => true,
        'show_saved_posts'      => true,
        'show_saved_patterns'   => true,
        'show_saved_collections'=> true,
    ];

    private function path(int $userId): string
    {
        return "privacy_prefs/{$userId}.json";
    }

    public function get(object $user): array
    {
        $path = $this->path($user->id);

        if (!Storage::exists($path)) {
            return self::DEFAULTS;
        }

        $stored = json_decode(Storage::get($path), true) ?? [];

        return array_merge(self::DEFAULTS, $stored);
    }

    public function save(int $userId, array $prefs): void
    {
        $filtered = [];
        foreach (self::DEFAULTS as $key => $default) {
            $filtered[$key] = isset($prefs[$key]) && filter_var($prefs[$key], FILTER_VALIDATE_BOOLEAN);
        }

        Storage::put($this->path($userId), json_encode($filtered, JSON_PRETTY_PRINT));
    }

    public function check(object $user, string $key): bool
    {
        $prefs = $this->get($user);
        return $prefs[$key] ?? (self::DEFAULTS[$key] ?? true);
    }
}
