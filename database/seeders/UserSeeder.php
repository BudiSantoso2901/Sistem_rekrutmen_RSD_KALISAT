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
            'name' => 'Administrator IT',
            'username' => 'sobri',
            'email' => 'adminit@example.com',
            'role' => 'IT',
            'password' => Hash::make('4dmin1t'),
        ]);

        User::create([
            'name' => 'Staff IT',
            'username' => 'Raes',
            'email' => 'sdm1@example.com',
            'role' => 'IT',
            'password' => Hash::make('kepalaityayaya'),
        ]);

         User::create([
            'name' => 'Staff SDM',
            'username' => 'adminrs',
            'email' => 'sdm12@example.com',
            'role' => 'IT',
            'password' => Hash::make('rsdkalisat2026'),
        ]);
    }
}
