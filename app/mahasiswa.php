<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    protected $table = "mahasiswa";
    protected $primaryKey = "nim";
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable =['nim','id_bagian','nama'];

    public function bagian(){
        return $this->belongsTo('App\bagian','id_bagian');
    }

    public function skripsi()
    {
        return $this->hasOne('App\skripsi', 'nim');
    }
}
