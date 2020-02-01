<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenis_kendaraan extends Model
{
    protected $table = 'jenis_kendaraan';

    public function spd()
    {
        return $this->hasMany('App\spd', 'id');
    }
}
