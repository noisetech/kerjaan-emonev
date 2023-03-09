<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelompokRekening extends Model
{
    protected $table = 'kelompok_rekening';

    protected $fillable = [
        'akun_rekening_id', 'kode', 'nomenklatur'
    ];

    public function akun_rekening()
    {
        return $this->belongsTo(AkunRekening::class, 'akun_rekening_id', 'id');
    }
}
