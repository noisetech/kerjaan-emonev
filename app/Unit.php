<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected  $table = 'unit';

    public function organisasi(){
        return $this->belongsTo(Organisasi::class, 'organisasi_id', 'id');
    }
}
