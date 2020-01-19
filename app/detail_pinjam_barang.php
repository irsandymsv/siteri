<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_pinjam_barang extends Model
{
    protected $table = 'detail_pinjam_barang';

    public $timestamps = false;

    protected $fillable = ['idpinjam_barang_fk', 'iddetail_data_barang_fk', 'jumlah', 'idsatuan_fk'];

    public function peminjaman_barang()
    {
        return $this->belongsTo('App\peminjaman_barang', 'idpinjam_barang_fk');
    }

    public function detail_data_barang()
    {
        return $this->belongsTo('App\detail_data_barang', 'iddetail_data_barang_fk');
    }

    public function satuan()
    {
        return $this->belongsTo('App\satuan', 'idsatuan_fk');
    }
}
