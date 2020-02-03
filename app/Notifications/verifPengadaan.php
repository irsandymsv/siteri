<?php

namespace App\Notifications;

use App\laporan_pengadaan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class verifPengadaan extends Notification
{
    use Queueable;
    protected $laporan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(laporan_pengadaan $laporan)
    {
        $this->laporan = $laporan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            return [
                'id'         => $this->laporan->id,
                'keterangan' => $this->laporan->keterangan,
                'updated_at' => $this->laporan->updated_at,
                'pesan'      => $this->laporan->pesan
            ];
        } else
        if (Auth::user()->jabatan->jabatan == 'Wakil Dekan 2') {
            return [
                'id'         => $this->laporan->id,
                'keterangan' => $this->laporan->keterangan,
                'updated_at' => $this->laporan->updated_at,
                'pesan'      => $this->laporan->pesan
            ];
        }
    }
}
