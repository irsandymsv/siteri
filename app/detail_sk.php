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
        'id_sk_akademik', 'nm_mhs','nim','id_bagian','judul'
    ];

    public function sk_akademik()
    {
        return $this->belongsTo('App\sk_akademik','id_sk_akademik');
    }

    public function pembimbing()
    {
        return $this->hasMany('App\pembimbing','id_detail_sk');
    }
}
