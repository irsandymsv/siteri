<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sk_akademik extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sk_akademik';

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


    public function tipe_sk()
    {
    	return $this->belongsTo('App\tipe_sk', 'id_tipe_sk');
    }

    public function detail_sk()
    {
    	return $this->hasMany('App\detail_sk', 'id_sk_akademik');
    }
}
