<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laporan';

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
        'id_jenis','id_user'
    ];

    public function jenis_laporan()
    {
        return $this->belongsTo('App\jenis_laporan', 'id_jenis');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function file_laporan()
    {
        return $this->hasMany('App\file_laporan','id_laporan');
    }
}
