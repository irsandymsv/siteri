<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_pinjam_ruang extends Model
{
    protected $table = 'detail_pinjam_ruang';

    public $timestamps = false;

    protected $fillable = ['idpinjam_ruang_fk', 'idruang_fk'];

    public function peminjaman_ruang()
    {
        return $this->belongsTo('App\peminjaman_ruang', 'idpinjam_ruang_fk');
    }

    public function data_ruang()
    {
        return $this->belongsTo('App\data_ruang', 'idruang_fk');
    }
}
