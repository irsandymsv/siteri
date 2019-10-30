<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class besaran_honor extends Model
{
    protected $table = "besaran_honor";
    protected $timestamps = FALSE;
    protected $guarded = ['id'];

    public function histori_besaran_honor()
    {
        return $this->hasMany('App\histori_besaran_honor','id_besaran_honor');
    }
}
