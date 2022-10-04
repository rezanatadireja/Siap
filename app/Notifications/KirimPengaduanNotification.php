<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class KirimPengaduanNotification extends Notification
{
    use Queueable;

    private $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data' => $this->user,
            'count' => $notifiable->unreadNotifications->count(),
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->user['user_id'],
            'name' => $this->user['name'],
            'jenis_pelayanan' => $this->user['jenis_pelayanan'],
            'status_pengaduan' => $this->user['status_pengaduan']
        ];
    }
}
