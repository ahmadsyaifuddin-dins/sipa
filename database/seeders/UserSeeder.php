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
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Kasir Toko',
            'email' => 'kasir@gmail.com',
            'role' => 'kasir',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Pemilik Toko',
            'email' => 'pemilik@gmail.com',
            'role' => 'pemilik',
            'password' => Hash::make('password'),
        ]);
    }
}
