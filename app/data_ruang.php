<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_ruang extends Model
{
    protected $table = 'data_ruang';

    public $timestamps = false;

    protected $guarded = ['id'];

    // protected $fillable = 'idruang_fk';

    public function detail_data_barang()
    {
        return $this->hasMany('App\detail_data_barang', 'idruang_fk');
    }

    public function detail_pinjam_ruang()
    {
        return $this->hasMany('App\detail_pinjam_ruang', 'idruang_fk');
    }

    public function surat_tugas()
    {
        return $this->hasMany('App\surat_tugas', 'id_ruang');
    }
}
