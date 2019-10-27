<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bagian extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bagian';

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


    public function user()
    {
        return $this->hasMany('App\User', 'id_bagian');
    }

    public function detail_sk()
    {
        return $this->hasMany('App\detail_sk', 'id_bagian');
    }

}
