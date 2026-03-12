<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use App\Services\NotificationPreferenceService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewLikeNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly User $liker,
        public readonly Post $post,
    ) {}

    public function via(object $notifiable): array
    {
        $allowed = app(NotificationPreferenceService::class)
            ->check($notifiable, 'notify_likes');

        return $allowed ? ['database'] : [];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type'       => 'like',
            'liker_id'   => $this->liker->id,
            'liker_name' => $this->liker->name,
            'post_id'    => $this->post->id,
            'message'    => $this->liker->name . ' liked your post.',
            'url'        => route('posts.show', $this->post->id),
        ];
    }
}
