<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class NotificationPreferenceService
{
    /** Keys and their default values */
    public const DEFAULTS = [
        'notify_followers'        => true,
        'notify_likes'            => true,
        'notify_comments'         => true,
        'notify_new_posts'        => true,
        'notify_new_patterns'     => true,
        'notify_new_collections'  => true,
    ];

    private function path(int $userId): string
    {
        return "notification_prefs/{$userId}.json";
    }

    /** Return merged preferences (stored values + defaults for any missing keys). */
    public function get(object $notifiable): array
    {
        $path = $this->path($notifiable->id);

        if (!Storage::exists($path)) {
            return self::DEFAULTS;
        }

        $stored = json_decode(Storage::get($path), true) ?? [];

        return array_merge(self::DEFAULTS, $stored);
    }

    /** Persist an array of preference keys → bool values. */
    public function save(int $userId, array $prefs): void
    {
        $filtered = [];
        foreach (self::DEFAULTS as $key => $default) {
            $filtered[$key] = isset($prefs[$key]) && filter_var($prefs[$key], FILTER_VALIDATE_BOOLEAN);
        }

        Storage::put($this->path($userId), json_encode($filtered, JSON_PRETTY_PRINT));
    }

    /** Convenience: check a single preference key for a notifiable. */
    public function check(object $notifiable, string $key): bool
    {
        $prefs = $this->get($notifiable);
        return $prefs[$key] ?? (self::DEFAULTS[$key] ?? true);
    }
}
