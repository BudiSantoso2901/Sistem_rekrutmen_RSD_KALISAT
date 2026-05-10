<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Posisi;

class PosisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posisis = [
            [
                'kode_pelamar' => '1',
                'id_rs' => '1',
                'nama_posisi' => 'Perawat',
                'deskripsi_posisi' => 'Bertugas memberikan pelayanan dan perawatan pasien.',
                'tanggal_ditutup' => '2026-06-30',
            ],
            [
                'kode_pelamar' => '2',
                'id_rs' => '1',
                'nama_posisi' => 'Dokter Umum',
                'deskripsi_posisi' => 'Melakukan pemeriksaan dan penanganan pasien umum.',
                'tanggal_ditutup' => '2026-06-30',
            ],
            [
                'kode_pelamar' => '3',
                'id_rs' => '2',
                'nama_posisi' => 'Staff IT',
                'deskripsi_posisi' => 'Mengelola sistem dan infrastruktur teknologi rumah sakit.',
                'tanggal_ditutup' => '2026-07-15',
            ],
            [
                'kode_pelamar' => '4',
                'id_rs' => '2',
                'nama_posisi' => 'Admin Rekam Medis',
                'deskripsi_posisi' => 'Mengelola data dan dokumen rekam medis pasien.',
                'tanggal_ditutup' => '2026-07-10',
            ],
        ];

        foreach ($posisis as $posisi) {
            Posisi::create($posisi);
        }
    }
}
