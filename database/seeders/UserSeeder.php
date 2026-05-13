<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::create([
            'name' => 'rsd Soebandi',
            'username' => 'rsdsoebandi',
            'email' => 'adminit@example.com',
            'role' => 'IT',
            'password' => Hash::make('rsdsoebandi2026'),
        ]);

        User::create([
            'name' => 'rsdbalung',
            'username' => 'rsdbalung',
            'email' => 'sdm166@example.com',
            'role' => 'IT',
            'password' => Hash::make('rsdbalung2026'),
        ]);

         User::create([
            'name' => 'rsdkalisat',
            'username' => 'rsdkalisat',
            'email' => 'sdm125@example.com',
            'role' => 'IT',
            'password' => Hash::make('rsdkalisat2026'),
        ]);
    }
}
