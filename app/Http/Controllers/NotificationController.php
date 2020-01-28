<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notification;

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
            }
            elseif ($notif->data['tipe_sutgas'] == "Surat Tugas Pembahas") {
                return redirect()->route('akademik.sutgas-pembahas.show', $notif->data['id']);
            }
            else {
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
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            return view('notifikasi.perlengkapan');
        } elseif (Auth::user()->jabatan->jabatan == 'Wakil Dekan 2') {
            return view('notifikasi.wadek2');
        } elseif (Auth::user()->jabatan->jabatan == 'Pengelola Data Akademik') {
            return view('notifikasi.akademik');
        }
    }
}
