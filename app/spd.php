<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class spd extends Model
{
    protected $table = 'spd';
    public $timestamps = false;
    protected $fillable = [
        'id_sk', 'id_jenis_kendaraan', 'asal', 'tujuan', 'uang_harian', 'id_penginapan', 'id_pendaftaran', 'biaya_penginapan', 'biaya_pendaftaran_acara',
    ];

    public function jenis_kendaraan()
    {
        return $this->belongsTo('App\jenis_kendaraan', 'id_jenis_kendaraan');
    }

    public function pendaftaran_acara()
    {
        return $this->belongsTo('App\pendaftaran', 'id_pendaftaran');
    }

    public function penginapan()
    {
        return $this->belongsTo('App\penginapan', 'id_penginapan');
    }
    public function surat_tugas()
    {
        return $this->belongsTo('App\surat_kepegawaian', 'id_sk');
    }
}
