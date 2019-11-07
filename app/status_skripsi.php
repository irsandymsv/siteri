<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_skripsi extends Model
{
    protected $table = "status_skripsi";
    public $timestamps = FALSE;
    protected $guarded = ['id'];

    public function skripsi()
    {
    	return $this->hasMany('App\skripsi', 'id_status_skripsi');
    }
}
