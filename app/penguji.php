<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penguji extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penguji';

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


    public function detail_sk()
    {
    	return $this->belongsTo('App\detail_sk', 'id_detail_sk');
    }

    public function penguji_utama()
    {
    	return $this->belongsTo('App\Users', 'id_penguji_utama', 'no_pegawai');
    }

    public function penguji_pendamping()
    {
    	return $this->belongsTo('App\Users', 'id_penguji_pendamping', 'no_pegawai');
    }
}
