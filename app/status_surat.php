<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_surat extends Model
{
    protected $table = 'status_surat';

    public function surat_tugas()
    {
        return $this->hasMany('App\surat_kepegawaian','id');
    }
}
