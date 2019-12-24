<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_detail_barang extends Model
{
    protected $table = 'datadetail_barang';

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

    public function status_barang_ruang()
    {
        return $this->belongsTo('App\status_barang_ruang', 'idstatus_fk');
    }

    public function peminjaman_barang()
    {
        return $this->hasMany('App\peminjaman_barang', 'iddatadetail_barang_fk');
    }
}
