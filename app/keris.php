<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keris extends Model
{
    protected $table = "keris";
    public $timestamps ="false";
    protected $guarded = ['id'];

    public function detail_skripsi()
    {
        return $this->hasMany('App\detail_skripsi', 'id_keris');
    }
}
