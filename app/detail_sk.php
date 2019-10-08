<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_sk extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_sk';

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
    	return $this->belongsTo('App\sk_akademik', 'id_sk_akademik');
    }

    public function jurusan()
    {
    	return $this->belongsTo('App\jurusan', 'id_jurusan');
    }

    public function pembimbing()
    {
    	return $this->hasMany('App\pembimbing', 'id_detail_sk');
    }

    public function penguji()
    {
    	return $this->hasMany('App\penguji', 'id_detail_sk');
    }
}
