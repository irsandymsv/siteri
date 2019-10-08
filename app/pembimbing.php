<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pembimbing extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pembimbing';

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
        'id_detail_sk', 'id_pembimbing_utama', 'id_pembimbing_pendamping'
    ];

    public function detail_sk()
    {
        return $this->belongsTo('App\detail_sk','id_detail_sk');
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
