<?php

namespace App\Notifications;

use App\Models\Collection;
use App\Models\User;
use App\Services\NotificationPreferenceService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewCollectionFromFollowedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly User       $creator,
        public readonly Collection $collection,
    ) {}

    public function via(object $notifiable): array
    {
        $allowed = app(NotificationPreferenceService::class)
            ->check($notifiable, 'notify_new_collections');

        return $allowed ? ['database'] : [];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type'           => 'new_collection',
            'creator_id'     => $this->creator->id,
            'creator_name'   => $this->creator->name,
            'collection_id'  => $this->collection->id,
            'message'        => $this->creator->name . ' published a new collection: ' . $this->collection->name . '.',
            'url'            => route('collections.show', $this->collection->id),
        ];
    }
}
