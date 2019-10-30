<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_skripsi extends Model
{
    protected $table = "detail_skripsi";
    protected $timestamps = FALSE;
    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->hasOne('App\mahasiswa', 'nim');
    }

    public function sk_sempro()
    {
        return $this->belongsTo('App\sk_sempro', 'id_sk_sempro');
    }

    public function sk_skripsi()
    {
        return $this->belongsTo('App\sk_skripsi', 'id_sk_skripsi');
    }

    public function pembimbing_utama()
    {
        return $this->belongsTo('App\User', 'id_pembimbing_utama');
    }

    public function pembimbing_pendamping()
    {
        return $this->belongsTo('App\User', 'id_pembimbing_pendamping');
    }

    public function penguji_utama()
    {
        return $this->belongsTo('App\User', 'id_penguji_utama');
    }

    public function penguji_pendamping()
    {
        return $this->belongsTo('App\User', 'id_penguji_pendamping');
    }

    public function pembahas1()
    {
        return $this->belongsTo('App\User', 'id_pembahas1');
    }

    public function pembahas2()
    {
        return $this->belongsTo('App\User', 'id_pembahas2');
    }

    public function keris()
    {
        return $this->belongsTo('App\keris', 'id_keris');
    }

    public function sk_honor()
    {
        return $this->belongsTo('App\sk_honor', 'id_sk_honor');
    }

    public function status_detail_skripsi()
    {
        return $this->belongsTo('App\status_detail_skripsi', 'id_status_detail_skripsi');
    }

    public function surat_tugas_pembimbing()
    {
        return $this->belongsTo('App\surat_tugas', 'id_surat_tugas_pembimbing');
    }

    public function surat_tugas_pembahas()
    {
        return $this->belongsTo('App\surat_tugas', 'id_surat_tugas_pembahas');
    }

    public function surat_tugas_penguji()
    {
        return $this->belongsTo('App\surat_tugas', 'id_surat_tugas_penguji');
    }

}
