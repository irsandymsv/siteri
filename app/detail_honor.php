<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_honor extends Model
{
    protected $table = "detail_honor";
    public $timestamps = TRUE;
    protected $guarded = ['id'];

    public function histori_besaran_honor()
    {
        return $this->belongsTo('App\histori_besaran_honor','id_histori_besaran_honor');
    }

    public function sk_honor(){
        return $this->belongsTo('App\sk_honor','id_sk_honor');
    }
}
