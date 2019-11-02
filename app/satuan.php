<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class satuan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'satuan';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
