<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class PengaduanNotification extends Notification
{
    use Queueable;

    private $pengaduanData;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pengaduanData)
    {
        $this->pengaduanData = $pengaduanData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject($this->pengaduanData['subject'])
                    ->line($this->pengaduanData['body'])
                    ->action($this->pengaduanData['action'], $this->pengaduanData['url'])
                    ->line($this->pengaduanData['thank you']);
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage ([
            'data' => $this->pengaduanData, 
            'count' => $notifiable->unreadNotifications->count(),
        ]);
    }

    // public function toTwilio($notifiable)
    // {
    //     return (new TwilioSmsMessage())
    //             ->content("Pelayanan {$this->pengaduanData['jenis_pelayanan']} 
    //             atas nama {$this->pengaduanData['user_name']} 
    //             telah {$this->pengaduanData['status_pengaduan']}, 
    //             silahkan login ke dalam sistem siap, terima kasih.");
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->pengaduanData['user_id'],
            'user_name' => $this->pengaduanData['user_name'],
            'jenis_pelayanan' => $this->pengaduanData['jenis_pelayanan'],
            'status_pengaduan' => $this->pengaduanData['status_pengaduan'],
        ];
    }
}
