<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubKegiatan extends Model
{
    protected $table = 'sub_kegiatan';

    public function kegiatan(){
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id', 'id');
    }

    public function satuan(){
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }
}
