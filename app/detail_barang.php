<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_barang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_barang';

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

    public function pengadaan()
    {
        return $this->belongsTo('App\pengadaan','id_barang');
    }

    public function kategori()
    {
        return $this->hasMany('App\kategori_barang','id_karegori');
    }
}
