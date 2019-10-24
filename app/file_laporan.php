<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class file_laporan extends Model
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

    public function laporan(){
        return $this->belongsTo('App\laporan','id_laporan');
    }
}
