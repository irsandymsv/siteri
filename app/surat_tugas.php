<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class surat_tugas extends Model
{
   protected $table = "surat_tugas";
   // public $timestamps = False;
   protected $guarded = ['id'];

   public function tipe_surat_tugas()
   {
       return $this->belongsTo('App\tipe_surat_tugas','id_tipe_surat_tugas');
   }

   public function status_surat_tugas()
   {
       return $this->belongsTo('App\status_surat_tugas','id_status_surat_tugas');
   }

    public function surat_tugas_pembimbing()
    {
        return $this->hasOne('App\detail_skripsi', 'id_surat_tugas_pembimbing');
    }

    public function surat_tugas_pembahas()
    {
        return $this->hasOne('App\detail_skripsi', 'id_surat_tugas_pembahas');
    }

    public function surat_tugas_penguji()
    {
        return $this->hasOne('App\detail_skripsi', 'id_surat_tugas_penguji');
    }
}
