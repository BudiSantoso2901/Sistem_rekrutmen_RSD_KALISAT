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
            'name' => 'Arif Yoni RSD Kalisat',
            'username' => 'arifyoni',
            'email' => 'rsdk1@example.com',
            'role' => 'IT',
            'password' => Hash::make('QW3aswl'),
            'rumah_sakit_id' => 3,
        ]);
       User::create([
            'name' => 'anto RSD Kalisat',
            'username' => 'anto',
            'email' => 'rsdk2@example.com',
            'role' => 'IT',
            'password' => Hash::make('ZZKqwe2'),
            'rumah_sakit_id' => 3,
        ]);
       User::create([
            'name' => 'Hadianto RSD Kalisat',
            'username' => 'hadianto',
            'email' => 'rsdk3@example.com',
            'role' => 'IT',
            'password' => Hash::make('KKqwe22'),
            'rumah_sakit_id' => 3,
        ]);
       User::create([
            'name' => 'dwiputri RSD Kalisat',
            'username' => 'dwiputri',
            'email' => 'rsdk4@example.com',
            'role' => 'IT',
            'password' => Hash::make('QW12kkop'),
            'rumah_sakit_id' => 3,
        ]);
       User::create([
            'name' => 'guntur RSD Kalisat',
            'username' => 'guntur',
            'email' => 'guntur@example.com',
            'role' => 'IT',
            'password' => Hash::make('WWWas122'),
            'rumah_sakit_id' => 3,
        ]);
    //    User::create([
    //         'name' => 'Yufi RSD Soebandi',
    //         'username' => 'yufi',
    //         'email' => 'adminit6@example.com',
    //         'role' => 'IT',
    //         'password' => Hash::make('yufi1005sampai1205'),
    //         'rumah_sakit_id' => 1,
    //     ]);
    //    User::create([
    //         'name' => 'Dina RSD Soebandi',
    //         'username' => 'dina',
    //         'email' => 'adminit7@example.com',
    //         'role' => 'IT',
    //         'password' => Hash::make('dina1206sampai1406'),
    //         'rumah_sakit_id' => 1,
    //     ]);
    //    User::create([
    //         'name' => 'Indah RSD Soebandi',
    //         'username' => 'indah',
    //         'email' => 'adminit8@example.com',
    //         'role' => 'IT',
    //         'password' => Hash::make('indah1407sampai1607'),
    //         'rumah_sakit_id' => 1,
    //     ]);
    //    User::create([
    //         'name' => 'Neni RSD Soebandi',
    //         'username' => 'neni',
    //         'email' => 'adminit9@example.com',
    //         'role' => 'IT',
    //         'password' => Hash::make('neni1607sampai1793'),
    //         'rumah_sakit_id' => 1,
    //     ]);

        // User::create([
        //     'name' => 'rsdbalung',
        //     'username' => 'rsdbalung',
        //     'email' => 'sdm166@example.com',
        //     'role' => 'IT',
        //     'password' => Hash::make('rekrutbalung2026'),
        //     'rumah_sakit_id' => 2,
        // ]);

        //  User::create([
        //     'name' => 'rsdkalisat',
        //     'username' => 'rsdkalisat',
        //     'email' => 'sdm125@example.com',
        //     'role' => 'IT',
        //     'password' => Hash::make('rekrutkalisat2026'),
        //     'rumah_sakit_id' => 3,
        // ]);
    }
}
