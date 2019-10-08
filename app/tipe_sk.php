<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipe_sk extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipe_sk';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function sk_akademik()
    {
        return $this->hasMany('App\sk_akademik','id_tipe_sk');
    }
}
