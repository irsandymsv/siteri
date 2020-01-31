<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perjalanan extends Model
{
    protected $table = 'perjalanan';

    protected $fillable = [
        'nama',
    ];

    public function surat_tugas()
    {
        return $this->hasMany('App\surat_kepegawaian', 'id');
    }
}
