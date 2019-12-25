<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjaman_barang extends Model
{
    protected $table = 'pinjam_barang';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function detail_data_barang()
    {
        return $this->belongsTo('App\detail_data_barang', 'iddetail_data_barang_fk');
    }

    public function satuan()
    {
        return $this->belongsTo('App\satuan', 'idsatuan_fk');
    }
}
