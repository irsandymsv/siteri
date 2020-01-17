<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pph extends Model
{
    protected $table = 'pph';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany('App\User', 'id_pph');
    }
}
