<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dosen_tugas extends Model
{
    protected $table = 'dosen_tugas';
    protected $fillable = [
        'id_sk','id_dosen', 'jabatan',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'id_dosen');
    }

    public function surat_tugas()
    {
        return $this->belongsTo('App\surat_kepegawaian', 'id_sk');
    }
}
