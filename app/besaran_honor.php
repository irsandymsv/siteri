<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class besaran_honor extends Model
{
    protected $table = "nama_honor";
    public $timestamps = FALSE;
    protected $guarded = ['id'];

    public function histori_besaran_honor()
    {
        return $this->hasMany('App\histori_besaran_honor','id_nama_honor');
    }
}
