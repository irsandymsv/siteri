<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_skripsi extends Model
{
    protected $table = "detail_skripsi";
    public $timestamps = TRUE;
    protected $guarded = ['id'];

    public function sk_sempro()
    {
        return $this->belongsTo('App\sk_sempro', 'id_sk_sempro');
    }

    public function sk_skripsi()
    {
        return $this->belongsTo('App\sk_skripsi', 'id_sk_skripsi');
    }

    public function keris()
    {
        return $this->belongsTo('App\keris', 'id_keris');
    }

    public function skripsi()
    {
        return $this->belongsTo('App\skripsi', 'id_skripsi');
    }

    public function surat_tugas()
    {
        return $this->hasMany('App\surat_tugas', 'id_detail_skripsi');
    }

}
