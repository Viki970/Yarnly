<?php

namespace App\Notifications;

use App\Models\User;
use App\Services\NotificationPreferenceService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewFollowNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly User $follower,
    ) {}

    public function via(object $notifiable): array
    {
        $allowed = app(NotificationPreferenceService::class)
            ->check($notifiable, 'notify_followers');

        return $allowed ? ['database'] : [];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type'          => 'follow',
            'follower_id'   => $this->follower->id,
            'follower_name' => $this->follower->name,
            'message'       => $this->follower->name . ' started following you.',
            'url'           => route('profile.show'),
        ];
    }
}
