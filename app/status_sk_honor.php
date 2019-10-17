<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_sk_honor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'status_sk_honor';

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

    public function sk_honor()
    {
        return $this->hasMany('App\sk_honor', 'id_status_sk_honor');
    }

}
