<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';

    protected $fillable = [
        'usaha_id',
        'blok',
    ];

    public function usaha()
    {
        return $this->belongsTo(Usaha::class);
    }

    public function detail()
    {
        return $this->hasMany(JawabanDetail::class);
    }
}