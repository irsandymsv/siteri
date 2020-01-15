<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_data_barang extends Model
{
    protected $table = 'detail_data_barang';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function data_barang()
    {
        return $this->belongsTo('App\data_barang', 'idbarang_fk');
    }

    public function data_ruang()
    {
        return $this->belongsTo('App\data_ruang', 'idruang_fk');
    }

    public function detail_pinjam_barang()
    {
        return $this->hasMany('App\detail_pinjam_barang', 'iddetail_data_barang_fk');
    }
}
