<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penginapan extends Model
{
    protected $table = 'penginapan';

    public function spd()
    {
        return $this->hasMany('App\spd', 'id');
    }
}
