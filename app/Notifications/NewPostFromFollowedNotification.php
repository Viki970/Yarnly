<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use App\Services\NotificationPreferenceService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewPostFromFollowedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly User $poster,
        public readonly Post $post,
    ) {}

    public function via(object $notifiable): array
    {
        $allowed = app(NotificationPreferenceService::class)
            ->check($notifiable, 'notify_new_posts');

        return $allowed ? ['database'] : [];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type'        => 'new_post',
            'poster_id'   => $this->poster->id,
            'poster_name' => $this->poster->name,
            'post_id'     => $this->post->id,
            'message'     => $this->poster->name . ' published a new post.',
            'url'         => route('posts.show', $this->post->id),
        ];
    }
}
