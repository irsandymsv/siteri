<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nama_template extends Model
{
    protected $table = "nama_template";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function template()
    {
        return $this->hasMany('App\template','id_nama_template');
    }

    public function template_terbaru()
    {
        return $this->hasOne('App\template', 'id_nama_template')->latest();
    }
}
