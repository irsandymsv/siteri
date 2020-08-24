<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\surat_kepegawaian;

class suratTugasKepegawaian extends Notification
{
	use Queueable;
	protected $surat;
	protected $tipe_notif;
	// protected $tujuan_user;

	/*
	tipe:
	- butuh_verif
	- butuh_revisi_(ktu atau staffpim)
	- sudah_siap
	- sudah_upload_bukti
	*/

	 /**
	  * Create a new notification instance.
	  *
	  * @return void
	  */
	 public function __construct(surat_kepegawaian $surat_tugas, $tipe)
	 {
		$this->surat = $surat_tugas;
		$this->tipe_notif = $tipe;
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
			'id_surat' => $this->surat->id,
			'nomor_surat' => $this->surat->nomor_surat,
			'tipe_notif' => $this->tipe_notif,
			'memo_created_at' => $this->surat->memo_created_at,
			'created_at' => $this->surat->created_at
			// 'tujuan_user' => $this->tujuan_user,
		];
	 }
 }
