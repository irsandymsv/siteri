<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sk_skripsi extends Model
{
    protected $table = "sk_skripsi";
    public $timestamps = TRUE;
    protected $guarded = ['id'];

    public function status_sk()
    {
        return $this->belongsTo('App\status_sk', 'id_status_sk');
    }

    public function template_penguji()
    {
        return $this->belongsTo('App\template', 'id_template_penguji');
    }

    public function template_pembimbing()
    {
        return $this->belongsTo('App\template', 'id_template_pembimbing');
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
