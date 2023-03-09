<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $table = 'organisasi';

    public function bidang(){
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }
}
