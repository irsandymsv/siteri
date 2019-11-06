<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class skripsi extends Model
{
    protected $table = "skripsi";
    public $timestamps = FALSE;
    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo('App\mahasiswa', 'nim');
    }

    public function detail_skripsi()
    {
        return $this->hasMany('App\detail_skripsi', 'id_skripsi');
    }
}
