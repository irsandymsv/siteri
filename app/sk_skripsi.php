<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sk_skripsi extends Model
{
    protected $table = "sk_skripsi";
    protected $primaryKey = "no_surat";
    public $timestamps = TRUE;
    protected $incrementing = FALSE;

    public function status_sk()
    {
        return $this->belongsTo('App\status_sk', 'id_status_sk');
    }

    public function detail_skripsi()
    {
        return $this->hasMany('App\detail_skripsi', 'id_sk_skripsi');
    }
}
