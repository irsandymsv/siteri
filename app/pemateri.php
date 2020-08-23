<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pemateri extends Model
{
    protected $table = 'pemateri';

    protected $fillable = [
        'id_sk','nama', 'instansi', 'biaya'
    ];

    public $timestamps = false;

    public function surat_tugas()
    {
        return $this->belongsTo('App\surat_kepegawaian', 'id_sk');
    }
}
