<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\histori_besaran_honor;

class nama_honor extends Model
{
    protected $table = "nama_honor";
    public $timestamps = FALSE;
    protected $guarded = ['id'];

    public function histori_besaran_honor()
    {
        return $this->hasMany('App\histori_besaran_honor','id_nama_honor');
    }

    public function besaran_honor_terbaru()
    {
        return $this->hasOne('App\histori_besaran_honor', 'id_nama_honor')->latest();
    }
}
