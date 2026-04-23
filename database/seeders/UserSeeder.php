<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Desa;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $desa = Desa::first();

        // Pengawas
        User::create([
            'name' => 'Pengawas',
            'email' => 'pengawas@mail.com',
            'password' => Hash::make('password'),
            'role' => 'pengawas',
            'desa_id' => null,
        ]);

        // Pengisi
        User::create([
            'name' => 'Pengisi',
            'email' => 'pengisi@mail.com',
            'password' => Hash::make('password'),
            'role' => 'pengisi',
            'desa_id' => $desa->id,
        ]);
    }
}