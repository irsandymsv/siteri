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
    public $timestamps = true;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function barang()
    {
        return $this->hasMany('App\detail_barang','id_barang');
    }

}
