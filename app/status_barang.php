<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_barang extends Model
{
    protected $table = 'status_barang';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function data_barang()
    {
        return $this->hasMany('App\data_barang', 'idstatus_fk');
    }
}
