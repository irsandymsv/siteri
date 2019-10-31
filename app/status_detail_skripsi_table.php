<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_detail_skripsi_table extends Model
{
    protected $table = "status_sk";
    public $timestamps = FALSE;
    protected $guarded = ['id'];

    public function detail_skripsi()
    {
        return $this->hasMany('App\detail_skripsi', 'id_status_detail_skripsi');
    }
}
