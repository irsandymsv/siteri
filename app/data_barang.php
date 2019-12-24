<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_barang extends Model
{
    protected $table = 'databarang';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function data_detail_barang()
    {
        return $this->hasMany('App\data_detail_barang', 'idbarang_fk');
    }
}
