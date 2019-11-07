<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_surat_tugas extends Model
{
   protected $table = 'status_surat_tugas';
   public $timestamps = false;
   protected $guarded = ['id'];

   public function surat_tugas()
   {
       return $this->hasMany('App\surat_tugas','id_status_surat_tugas');
   }
}
