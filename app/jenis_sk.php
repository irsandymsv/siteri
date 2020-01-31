<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenis_sk extends Model
{
    protected $table = 'jenis_sk';

    public function surat_tugas()
    {
        return $this->hasMany('App\surat_kepegawaian', 'jenis_surat');
    }
}
