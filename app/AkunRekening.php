<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AkunRekening extends Model
{
    protected $table = 'akun_rekening';

    protected $fillable = [
        'akun_rekening_id', 'kode', 'nomenklatur'
    ];

    public function kelompok_rekening()
    {
        return $this->hasMany(AkunRekening::class, 'akun_rekening_id', 'id');
    }
}
