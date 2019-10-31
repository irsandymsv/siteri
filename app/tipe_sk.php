<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipe_sk extends Model
{
    protected $table = "tipe_sk";
    public $timestamps = FALSE;
    protected $guarded = ['id'];

    public function sk_honor()
    {
        return $this->hasMany('App\sk_honor', 'id_tipe_sk');
    }

}
