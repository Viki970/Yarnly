<?php

namespace App\Notifications;

use App\Models\Pattern;
use App\Models\User;
use App\Services\NotificationPreferenceService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewPatternFromFollowedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly User    $creator,
        public readonly Pattern $pattern,
    ) {}

    public function via(object $notifiable): array
    {
        $allowed = app(NotificationPreferenceService::class)
            ->check($notifiable, 'notify_new_patterns');

        return $allowed ? ['database'] : [];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type'         => 'new_pattern',
            'creator_id'   => $this->creator->id,
            'creator_name' => $this->creator->name,
            'pattern_id'   => $this->pattern->id,
            'message'      => $this->creator->name . ' published a new pattern: ' . $this->pattern->title . '.',
            'url'          => route('patterns.view', $this->pattern->id),
        ];
    }
}
