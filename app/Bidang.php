<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $table = 'bidang';

    public function urusan()
    {
        return $this->belongsTo(Urusan::class, 'urusan_id', 'id');
    }
}
