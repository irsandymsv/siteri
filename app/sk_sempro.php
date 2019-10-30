<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sk_sempro extends Model
{
    protected $table = "sk_sempro";
    protected $primaryKey = "no_surat";
    protected $timestamps = TRUE;
    protected $incrementing = FALSE;

    public function status_sk()
    {
        return $this->belongsTo('App\status_sk','id_status_sk');
    }

    public function detail_skripsi()
    {
        return $this->hasMany('App\detail_skripsi', 'id_sk_sempro');
    }
}
