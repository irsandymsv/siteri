<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjaman_ruang extends Model
{
    protected $table = 'pinjam_ruang';

    public $timestamps = false;

    protected $guarded = ['id'];
}
