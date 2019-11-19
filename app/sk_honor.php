<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sk_honor extends Model
{
    protected $table = "sk_honor";
    public $timestamps = TRUE;
    protected $guarded = ['id'];

    public function status_sk_honor()
    {
        return $this->belongsTo('App\status_sk_honor', 'id_status_sk_honor');
    }

    public function sk_sempro()
    {
        return $this->hasOne('App\sk_sempro', 'id_sk_honor');
    }

    public function sk_skripsi()
    {
        return $this->hasOne('App\sk_skripsi', 'id_sk_honor');
    }

    public function detail_honor()
    {
        return $this->hasMany('App\detail_honor','id_sk_honor');
    }
}
