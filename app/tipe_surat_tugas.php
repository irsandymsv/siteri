<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipe_surat_tugas extends Model
{
    protected $table="tipe_surat_tugas";
    public $timestamps = FALSE;
    protected $guarded=['id'];

    public function surat_tugas()
    {
        $this->hasMany('App\surat_tugas','id_tipe_surat_tugas');
    }
}
