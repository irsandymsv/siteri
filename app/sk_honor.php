<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sk_honor extends Model
{
    protected $table = "sk_honor";
    protected $timestamps = TRUE;

    public function tipe_sk()
    {
        return $this->belongsTo('App\tipe_sk', 'id_tipe_sk');
    }

    public function status_sk_honor()
    {
        return $this->belongsTo('App\status_sk_honor', 'id_status_sk_honor');
    }

    public function honor_pembimbing1()
    {
        return $this->belongsTo('App\histori_besaran_honor', 'id_honor_pembimbing1');
    }

    public function honor_pembimbing2()
    {
        return $this->belongsTo('App\histori_besaran_honor', 'id_honor_pembimbing2');
    }

    public function honor_penguji()
    {
        return $this->belongsTo('App\histori_besaran_honor', 'id_honor_penguji');
    }

    public function honor_pembahas()
    {
        return $this->belongsTo('App\histori_besaran_honor', 'id_honor_pembahas');
    }

    public function detail_skripsi()
    {
        return $this->has_many('App\detail_skripsi', 'id_sk_honor');
    }
}
