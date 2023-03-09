<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dinas extends Model
{
    protected $table = 'dinas';

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id', 'id');
    }

    protected $fillable = [
        'wilayah_id', 'dinas', 'wilayah_id', 'foto', 'icon'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'dinas_users', 'dinas_id', 'users_id');
    }
}
