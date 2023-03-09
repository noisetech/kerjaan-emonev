<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urusan extends Model
{
    protected $table = 'urusan';

    // relasi ke bidang one to many
    public function bidang()
    {
        $this->hasMany(Bidang::class, 'urusan_id');
    }
}
