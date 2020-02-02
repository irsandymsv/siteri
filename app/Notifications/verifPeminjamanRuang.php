<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use App\peminjaman_ruang;

class verifPeminjamanRuang extends Notification
{
    use Queueable;
    protected $laporan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(peminjaman_ruang $laporan)
    {
        $this->laporan = $laporan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
            return [
                'id'         => $this->laporan->id,
                'kegiatan'   => $this->laporan->kegiatan,
                'updated_at' => $this->laporan->updated_at
            ];
        } else
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            return [
                'id'         => $this->laporan->id,
                'kegiatan'   => $this->laporan->kegiatan,
                'verif_baper' => $this->laporan->verif_baper,
                'updated_at' => $this->laporan->updated_at
            ];
        } else
        if (Auth::user()->jabatan->jabatan == 'KTU') {
            return [
                'id'         => $this->laporan->id,
                'kegiatan'   => $this->laporan->kegiatan,
                'verif_ktu'  => $this->laporan->verif_ktu,
                'updated_at' => $this->laporan->updated_at
            ];
        }
    }
}
