<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_ruang extends Model
{
    protected $table = 'dataruang';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function data_detail_barang()
    {
        return $this->hasMany('App\data_detail_barang', 'idruang_fk');
    }
}
