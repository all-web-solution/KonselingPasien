<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Apotek',
            'email' => 'admin@apoteksehat.com',
            'password' => Hash::make('password123'), // Gunakan password ini untuk login
        ]);
    }
}