<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RumahSakit;

class RumahSakitSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_rs' => 'RSD Soebandi',
                'kode_rs' => '1',
            ],
            [
                'nama_rs' => 'RSD Balung',
                'kode_rs' => '2',
            ],
            [
                'nama_rs' => 'RSD Kalisat',
                'kode_rs' => '3',
            ],
        ];

        foreach ($data as $item) {

            RumahSakit::updateOrCreate(
                ['kode_rs' => $item['kode_rs']],
                $item
            );
        }
    }
}
