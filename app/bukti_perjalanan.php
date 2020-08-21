<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bukti_perjalanan extends Model
{
    protected $table = 'bukti_perjalanan';
    protected $fillable = [
        'id_spd','transportasi','penginapan','pendaftaran', 'uploaded_at', 'id_user',
    ];
    protected $cast = [
        'transportasi' => 'array',
        'penginapan' => 'array',
        'pendaftaran' => 'array'
    ];

    public $timestamps = false;

    public function setTransportasiAttribute($transportasi)
    {
        $this->attributes['transportasi'] = json_encode($transportasi);
    }

    public function setPenginapanAttribute($penginapan)
    {
        $this->attributes['penginapan'] = json_encode($penginapan);
    }

    public function setPendaftaranAttribute($pendaftaran)
    {
        $this->attributes['pendaftaran'] = json_encode($pendaftaran);
    }
}
