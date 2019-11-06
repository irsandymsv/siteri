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

    public function skripsi()
    {
        return $this->hasOne('App\skripsi', 'nim');
    }
}
