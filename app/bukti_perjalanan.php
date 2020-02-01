<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bukti_perjalanan extends Model
{
    protected $table = 'bukti_perjalanan';
    protected $fillable = [
        'id_spd','nama', 'uploaded_at', 'id_user',
    ];

    public $timestamps = false;
}
