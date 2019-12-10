<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sk_skripsi extends Model
{
    protected $table = "sk_skripsi";
    protected $primaryKey = "no_surat";
    public $timestamps = TRUE;
    public $incrementing = FALSE;
    protected $fillable = ['no_surat', 'id_status_sk', 'tgl_sk_pembimbing', 'tgl_sk_penguji', 'verif_ktu', 'pesan_revisi', 'id_template'];


    public function status_sk()
    {
        return $this->belongsTo('App\status_sk', 'id_status_sk');
    }

    public function template()
    {
        return $this->belongsTo('App\template', 'id_template');
    }

    public function sk_honor()
    {
        return $this->belongsTo('App\sk_honor', 'id_sk_honor');
    }

    public function detail_skripsi()
    {
        return $this->hasMany('App\detail_skripsi', 'id_sk_skripsi');
    }
}
