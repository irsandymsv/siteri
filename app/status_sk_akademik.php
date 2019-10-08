<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_sk_akademik extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'status_sk_akademik';

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status'
    ];

    public function sk_akademik()
    {
        return $this->hasMany('App\sk_akademik','id_status_sk_akademik');
    }
}
