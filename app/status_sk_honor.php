<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_sk_honor extends Model
{
    protected $table = "status_sk_honor";
    protected $timestamps = FALSE;
    protected $guarded = ['id'];

    public function sk_honor()
    {
        return $this->hasMany('App\sk_honor', 'id_status_sk_honor');
    }
}
