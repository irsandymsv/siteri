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
    // protected $fillable = [
    //     'id_sk_akademik', 'nama_mhs', 'nim', 'id_bagian','judul'
    // ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    public function sk_akademik()
    {
    	return $this->belongsTo('App\sk_akademik', 'id_sk_akademik');
    }

    public function bagian()
    {
    	return $this->belongsTo('App\bagian', 'id_bagian')->where('is_jurusan', 1);
    }

    public function penguji_utama()
    {
        return $this->belongsTo('App\User', 'id_penguji_utama');
    }

    public function penguji_pendamping()
    {
        return $this->belongsTo('App\User', 'id_penguji_pendamping');
    }

    public function pembimbing_utama()
    {
        return $this->belongsTo('App\User', 'id_pembimbing_utama');
    }

    public function pembimbing_pendamping()
    {
        return $this->belongsTo('App\User', 'id_pembimbing_pendamping');
    }
}
