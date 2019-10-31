<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_sk extends Model
{
    protected $table = "status_sk";
    public $timestamps = FALSE;
    protected $guarded = ['id'];

    public function sk_sempro()
    {
        return $this->hasMany('App\sk_sempro','id_status_sk');
    }

    public function sk_skripsi()
    {
        return $this->hasMany('App\sk_skripsi', 'id_status_sk');
    }
}
