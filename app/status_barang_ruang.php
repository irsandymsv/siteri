<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_barang_ruang extends Model
{
    protected $table = 'status_barang_ruang';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function data_detail_barang()
    {
        return $this->hasMany('App\data_detail_barang', 'idstatus_fk');
    }
}
