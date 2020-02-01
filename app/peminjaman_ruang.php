<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjaman_ruang extends Model
{
    protected $table = 'pinjam_ruang';

    public $timestamps = true;

    protected $guarded = ['id'];

    public function detail_pinjam_ruang()
    {
        return $this->hasMany('App\detail_pinjam_ruang', 'idpinjam_ruang_fk');
    }
}
