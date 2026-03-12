<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use App\Services\NotificationPreferenceService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly User   $commenter,
        public readonly Post   $post,
        public readonly string $commentBody,
    ) {}

    public function via(object $notifiable): array
    {
        $allowed = app(NotificationPreferenceService::class)
            ->check($notifiable, 'notify_comments');

        return $allowed ? ['database'] : [];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type'           => 'comment',
            'commenter_id'   => $this->commenter->id,
            'commenter_name' => $this->commenter->name,
            'post_id'        => $this->post->id,
            'message'        => $this->commenter->name . ' commented on your post.',
            'url'            => route('posts.show', $this->post->id),
        ];
    }
}
