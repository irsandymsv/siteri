<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori_barang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kategori_barang';

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

    public function barang()
    {
        return $this->belongsTo('App\detail_barang','id_kategori');
    }
}
