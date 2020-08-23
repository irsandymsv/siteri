<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class surat_kepegawaian extends Model
{
    protected $table = 'surat_kepegawaian';
    public $timestamps = false;
    protected $fillable = [
        'nomor_surat', 'jenis_surat', 'keterangan', 'started_at', 'end_at', 'status', 'surat_in_out', 'perjalanan','lokasi', 'memo_created_at', 'created_at'
    ];

    public function dosen_tugas()
    {
        return $this->hasMany('App\dosen_tugas', 'id');
    }
    public function spd()
    {
        return $this->hasMany('App\spd', 'id');
    }

    public function jenis_sk()
    {
        return $this->belongsTo('App\jenis_sk', 'jenis_surat');
    }

    public function status_sk()
    {
        return $this->belongsTo('App\status_surat', 'status');
    }
    
    public function surat_in_outs()
    {
        return $this->belongsTo('App\surat_in_out', 'surat_in_out');
    }

    public function perjalanans()
    {
        return $this->belongsTo('App\perjalanan', 'perjalanan');
    }

    public function pemateri()
    {
        return $this->belongsTo('App\pemateri', 'id');
    }
}
