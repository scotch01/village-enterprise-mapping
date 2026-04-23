<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Desa;

class DesaSeeder extends Seeder
{
    public function run(): void
    {
        Desa::create([
            'nama' => 'Cimparuh',
            'kecamatan' => 'Pariaman Tengah',
            'kabupaten' => 'Kota Pariaman',
            'provinsi' => 'Sumatera Barat',
        ]);
    }
}