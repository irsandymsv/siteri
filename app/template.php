<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class template extends Model
{
    protected $table = "template";
    public $timestamps = true;
    protected $guarded = ['id'];

    public function nama_template()
    {
        return $this->belongsTo('App\nama_template','id_nama_template');
    }

    public function sk_sempro()
    {
        return $this->hasMany('App\sk_sempro','id_template');
    }

    public function sk_skripsi()
    {
        return $this->hasMany('App\sk_skripsi','id_template');
    }
}
