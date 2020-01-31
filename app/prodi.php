<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prodi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prodi';

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
        return $this->hasMany('App\User', 'id');
    }
}
