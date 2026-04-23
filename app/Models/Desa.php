<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $table = 'desa';

    protected $fillable = [
        'nama',
        'kecamatan',
        'kabupaten',
        'provinsi',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}