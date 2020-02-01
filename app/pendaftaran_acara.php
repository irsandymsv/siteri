<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pendaftaran_acara extends Model
{
    protected $table = 'pendaftaran_acara';

    public function spd()
    {
        return $this->hasMany('App\spd', 'id');
    }
}
