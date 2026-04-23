<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanDetail extends Model
{
    protected $table = 'jawaban_detail';

    protected $fillable = [
        'jawaban_id',
        'kode_pertanyaan',
        'value',
        'value_array',
        'value_object',
    ];

    protected $casts = [
        'value_array' => 'array',
        'value_object' => 'array',
    ];

    public function jawaban()
    {
        return $this->belongsTo(Jawaban::class);
    }
}