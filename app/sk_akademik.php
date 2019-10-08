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
    public $timestamps = true;

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
        'id_tipe_sk', 'jenis', 'id_status_sk_akademik', 'verif_ktu', 'verif_dekan'
    ];

    public function tipe_sk()
    {
        return $this->belongsTo('App\tipe_sk','id_tipe_sk');
    }

    public function status_sk_akademik()
    {
        return $this->belongsTo('App\status_sk_akademik','id_status_sk_akademik');
    }

    public function detail_sk()
    {
        return $this->hasMany('App\detail_sk','id_sk_akademik');
    }
}
