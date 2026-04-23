<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    protected $table = 'usaha';

    protected $fillable = [
        'desa_id',
        'user_id',
        'nama_usaha',
        'alamat',
        'telepon',
        'email',
        'website',
        'latitude',
        'longitude',
        'foto',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }
}