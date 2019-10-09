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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_sk_akademik', 'nama_mhs', 'nim', 'id_bagian','judul'
    ];


    public function sk_akademik()
    {
    	return $this->belongsTo('App\sk_akademik', 'id_sk_akademik');
    }

    public function bagian()
    {
    	return $this->belongsTo('App\bagian', 'id_bagian')->where('is_jurusan', 1);
    }

    public function pembimbing()
    {
    	return $this->hasOne('App\pembimbing', 'id_detail_sk');
    }

    public function penguji()
    {
    	return $this->hasOne('App\penguji', 'id_detail_sk');
    }
}
