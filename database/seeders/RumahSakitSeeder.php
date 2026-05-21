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
                'kode_rs' => '01',
            ],
            [
                'nama_rs' => 'RSD Balung',
                'kode_rs' => '02',
            ],
            [
                'nama_rs' => 'RSD Kalisat',
                'kode_rs' => '03',
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
