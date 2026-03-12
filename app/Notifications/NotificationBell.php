<?php

namespace App\Notifications;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationBell extends Component
{
    public int $unreadCount = 0;

    /** @var \Illuminate\Support\Collection */
    public $notifications;

    protected $listeners = ['notificationsRead' => 'refresh'];

    public function mount(): void
    {
        $this->loadNotifications();
    }

    public function loadNotifications(): void
    {
        if (!Auth::check()) {
            $this->notifications = collect();
            $this->unreadCount = 0;
            return;
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $this->notifications = $user->notifications()
            ->latest()
            ->limit(10)
            ->get()
            ->map(fn ($n) => [
                'id'         => $n->id,
                'message'    => $n->data['message'] ?? '',
                'url'        => $n->data['url'] ?? '#',
                'type'       => $n->data['type'] ?? 'general',
                'read'       => !is_null($n->read_at),
                'created_at' => $n->created_at->diffForHumans(),
            ]);

        $this->unreadCount = $user->unreadNotifications()->count();
    }

    public function markAllRead(): void
    {
        if (!Auth::check()) {
            return;
        }

        Auth::user()->unreadNotifications->markAsRead();
        $this->loadNotifications();
    }

    public function markRead(string $id): void
    {
        if (!Auth::check()) {
            return;
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $notification = $user->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        $this->loadNotifications();
    }

    public function refresh(): void
    {
        $this->loadNotifications();
    }

    public function render()
    {
        return view('notifications.notification-bell');
    }
}
