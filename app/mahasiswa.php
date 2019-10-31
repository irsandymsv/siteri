<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    protected $table = "mahasiswa";
    protected $primaryKey = "nim";
    public $timestamps = "false";
    public $incrementing = false;

    public function bagian(){
        return $this->belongsTo('App\bagian','id_bagian');
    }

    public function detail_skripsi()
    {
        return $this->hasOne('App\detail_skripsi', 'nim');
    }
}
