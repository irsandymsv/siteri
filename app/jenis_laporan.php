<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenis_laporan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jenis_laporan';

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
        'jenis'
    ];

    public function laporan()
    {
        return $this->hasMany('App\laporan','id_laporan');
    }
}
