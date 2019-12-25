<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengadaan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengadaan';

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

    public function laporan_pengadaan()
    {
        return $this->belongsTo('App\laporan_pengadaan', 'id_laporan');
    }

    public function satuan()
    {
        return $this->belongsTo('App\satuan', 'id_satuan');
    }
}
