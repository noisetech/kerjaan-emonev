<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table = 'wilayah';

    protected $fillable = [
        'wilayah'
    ];

    public function dinas(){
        return $this->hasMany(Dinas::class, 'wilayah_id');
    }
}
