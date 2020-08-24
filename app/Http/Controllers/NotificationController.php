<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notification;
use App\surat_kepegawaian;
use App\spd;

class NotificationController extends Controller
{
	public function index()
	{
		$notifications = Auth::user()->notifications;
        // dd($notifications);
		return view('notifikasi.index', ['notifications' => $notifications]);
	}

	public function read($id)
	{
		$notif = Auth::user()->unreadNotifications->where("id", $id)->first();
        // dd($notif);
		$notif->markAsRead();

		if ($notif->type == 'App\Notifications\verifSutgasKtu') {
			if ($notif->data['tipe_sutgas'] == "Surat Tugas Pembimbing") {
				return redirect()->route('akademik.sutgas-pembimbing.show', $notif->data['id']);
			} elseif ($notif->data['tipe_sutgas'] == "Surat Tugas Pembahas") {
				return redirect()->route('akademik.sutgas-pembahas.show', $notif->data['id']);
			} else {
				return redirect()->route('akademik.sutgas-penguji.show', $notif->data['id']);
			}
		} 
		elseif ($notif->type == 'App\Notifications\verifSKSemproKtu') {
			return redirect()->route('akademik.sempro.show', $notif->data['no_surat']);
		} 
		elseif ($notif->type == 'App\Notifications\verifSKSkripsiKtu') {
			return redirect()->route('akademik.skripsi.show', $notif->data['id']);
		} 
		elseif ($notif->type == 'App\Notifications\verifPengadaan') {
			if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
				return redirect()->route('perlengkapan.pengadaan.show', $notif->data['id']);
			} else {
				return redirect()->route('wadek2.pengadaan.show', $notif->data['id']);
			}
		} elseif ($notif->type == 'App\Notifications\verifPeminjamanBarang') {
			if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
				return redirect()->route('ormawa.peminjaman_barang.show', $notif->data['id']);
			} else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
				return redirect()->route('perlengkapan.peminjaman_barang.show', $notif->data['id']);
			} else {
				return redirect()->route('ktu.peminjaman_barang.show', $notif->data['id']);
			}
		} elseif ($notif->type == 'App\Notifications\verifPeminjamanRuang') {
			if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
				return redirect()->route('ormawa.peminjaman_ruang.show', $notif->data['id']);
			} else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
				return redirect()->route('perlengkapan.peminjaman_ruang.show', $notif->data['id']);
			} else {
				return redirect()->route('ktu.peminjaman_ruang.show', $notif->data['id']);
			}
		} 
		elseif ($notif->type == 'App\Notifications\suratTugasKepegawaian') {
			if (Auth::user()->jabatan->jabatan == "KTU") {
				return redirect()->route('ktu.surat.preview', $notif->data['id_surat']);
			} 
			else if(Auth::user()->jabatan->jabatan == "Sekretaris Pimpinan") {
				return redirect()->route('staffpim.sp.preview', $notif->data['id_surat']);
			}
			else if(Auth::user()->jabatan->jabatan == "Wakil Dekan 2") {
				return redirect()->route('wadek2.surat.preview', $notif->data['id_surat']);
			}
			else if(Auth::user()->jabatan->jabatan == "BPP") {
				if ($notif->data['tipe_notif'] == 'butuh_verif') {
					return redirect()->route('bpp.surat.preview', $notif->data['id_surat']);
				} 
				else if ($notif->data['tipe_notif'] == 'sudah_upload_bukti'){
					$surat_tugas = surat_kepegawaian::where('id', $notif->data['id_surat'])->with('spd')->first();
					return redirect()->route('bpp.spd.view', $surat_tugas->spd->id_spd);
				}
			}
			else if (Auth::user()->jabatan->jabatan == "Dosen"){
				return redirect()->route('dosen.surat.preview', $notif->data['id_surat']);
			}
			else if (Auth::user()->jabatan->jabatan == "Wakil Dekan 1"){
				return redirect()->route('wadek1.surat.preview', $notif->data['id_surat']);
			}
			else if (Auth::user()->jabatan->jabatan == "Pemroses Mutasi Kepegawaian"){
				return redirect()->route('kepegawaian.surat.preview', $notif->data['id_surat']);
			}
		}
		else {
			echo "hai";
		}
	}

	public function readAll()
	{
		try {
			Auth::user()->unreadNotifications()->update(['read_at' => now()]);
			return 'success';
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function load()
	{
		if (Auth::check()) {
			if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
				return view('notifikasi.perlengkapan');
			} elseif (Auth::user()->jabatan->jabatan == 'Dekan') {
				return view('notifikasi.dekan');
			} elseif (Auth::user()->jabatan->jabatan == 'Wakil Dekan 1') {
				return view('notifikasi.wadek1');
			} elseif (Auth::user()->jabatan->jabatan == 'Wakil Dekan 2') {
				return view('notifikasi.wadek2');
			} elseif (Auth::user()->jabatan->jabatan == 'Dosen') {
				return view('notifikasi.dosen');
			} elseif (Auth::user()->jabatan->jabatan == 'Pengelola Data Akademik') {
				return view('notifikasi.akademik');
			} elseif (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
				return view('notifikasi.ormawa');
			} elseif (Auth::user()->jabatan->jabatan == 'KTU') {
				return view('notifikasi.ktu');
			} elseif (Auth::user()->jabatan->jabatan == 'Pemroses Mutasi Kepegawaian') {
				return view('notifikasi.kepegawaian');
			} elseif (Auth::user()->jabatan->jabatan == 'Sekretaris Pimpinan') {
				return view('notifikasi.staff_pimpinan');
			} elseif (Auth::user()->jabatan->jabatan == 'BPP') {
				return view('notifikasi.bpp');
			}
		}
	}
}
