<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_barang extends Model
{
    protected $table = 'data_barang';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function detail_data_barang()
    {
        return $this->hasMany('App\detail_data_barang', 'idbarang_fk');
    }

    public function status_barang()
    {
        return $this->belongsTo('App\status_barang', 'idstatus_fk');
    }
}
