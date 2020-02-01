<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class surat_in_out extends Model
{
    protected $table = 'surat_in_out';

    protected $fillable = [
        'nama',
    ];

    public function surat_tugas()
    {
        return $this->hasMany('App\surat_kepegawaian', 'id');
    }
}
