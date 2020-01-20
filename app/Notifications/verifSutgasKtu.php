<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\surat_tugas;

class verifSutgasKtu extends Notification
{
  use Queueable;
  protected $surat;
    // protected $waktu_verif;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(surat_tugas $sutgas)
    {
     $this->surat = $sutgas;
        // $this->waktu_verif = $dateTime;
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
        return [
            'id' => $this->surat->id,
            'tipe_sutgas' => $this->surat->tipe_surat_tugas->tipe_surat,
            'no_surat' => $this->surat->no_surat,
            'created_at' => $this->surat->created_at,
            'waktu_verif' => $this->surat->updated_at
        ];
    }
}
