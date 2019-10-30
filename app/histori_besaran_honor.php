<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class histori_besaran_honor extends Model
{
    protected $table = "histori_besaran_honor";
    protected $timestamps = FALSE;

    public function besaran_honor()
    {
        return $this->belongsTo('App\besaran_honor','id_besaran_honor');
    }


    public function honor_pembimbing1()
    {
        return $this->hasMany('App\sk_honor', 'id_honor_pembimbing1');
    }

    public function honor_pembimbing2()
    {
        return $this->hasMany('App\sk_honor', 'id_honor_pembimbing2');
    }

    public function honor_penguji()
    {
        return $this->hasMany('App\sk_honor', 'id_honor_penguji');
    }

    public function honor_pembahas()
    {
        return $this->hasMany('App\sk_honor', 'id_honor_pembahas');
    }
}
