<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjaman_barang extends Model
{
    protected $table = 'pinjam_barang';

    public $timestamps = true;

    protected $guarded = ['id'];

    public function detail_pinjam_barang()
    {
        return $this->hasMany('App\detail_pinjam_barang', 'idpinjam_barang_fk');
    }
}
