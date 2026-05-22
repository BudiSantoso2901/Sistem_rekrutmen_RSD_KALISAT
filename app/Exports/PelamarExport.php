<?php

namespace App\Exports;

use App\Models\Pelamar;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class PelamarExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize,
    WithStyles,
    WithEvents
{
    protected $user;
    protected $id_posisi;
    protected $status;

    public function __construct(
        $user,
        $id_posisi = null,
        $status = null
    ) {
        $this->user = $user;
        $this->id_posisi = $id_posisi;
        $this->status = $status;
    }

    private const JENIS_FILE = [

        'cv' => true,
        'ijazah_transkrip' => true,
        'ktp' => true,
        'pas_foto' => true,
        'str_sip' => false,
        'sertifikat' => false,
        'surat_pengalaman' => false,
        'skck' => true,
        'surat_sehat' => true,
        'surat_pernyataan' => true,
        'surat_lamaran' => true,
        'surat_tidak_menuntut_diangkat_asn' => true,
    ];

    public function collection()
    {
        return Pelamar::with([
            'posisi',
            'files',
            'rumahSakit'
        ])

            ->where(
                'rumah_sakit_id',
                $this->user->rumah_sakit_id
            )

            ->when(
                $this->id_posisi,
                function ($query) {

                    $query->where(
                        'id_posisi',
                        $this->id_posisi
                    );
                }
            )

            ->when(
                $this->status,
                function ($query) {

                    $query->where(
                        'status_pelamar',
                        $this->status
                    );
                }
            )

            ->latest()

            ->get()

            ->map(function ($pelamar) {

                $uploaded = $pelamar
                    ->files
                    ->pluck('jenis_file')
                    ->toArray();

                $statusFile = function ($jenis)
                use (
                    $uploaded,
                    $pelamar
                ) {

                    if (
                        $jenis === 'str_sip'
                        &&
                        $pelamar->jenis_pelamar !== 'nakes'
                    ) {

                        return '—';
                    }

                    if (
                        in_array(
                            $jenis,
                            $uploaded
                        )
                    ) {

                        return '✔';
                    }

                    return self::JENIS_FILE[$jenis]
                        ? '✘'
                        : '—';
                };

                return [

                    'Nomor Peserta' =>
                    $pelamar->nomer_peserta,

                    'Nama' =>
                    $pelamar->nama,

                    'NIK' =>
                    $pelamar->nik,

                    'Jenis Kelamin' =>
                    $pelamar->jenis_kelamin,

                    'Jenis Pelamar' =>
                    $pelamar->jenis_pelamar,

                    'Email' =>
                    $pelamar->email,

                    'No HP' =>
                    $pelamar->no_hp,

                    'Kota Domisili' =>
                    $pelamar->kota_domisili,

                    'Jenjang' =>
                    $pelamar->jenjang,

                    'Alamat' =>
                    $pelamar->alamat,

                    'Pengalaman Kerja' =>
                    $pelamar->pengalaman_kerja,

                    'Ket. Pengalaman' =>
                    $pelamar->keterangan_pengalaman,

                    'Catatan' =>
                    $pelamar->catatan,

                    'Posisi' =>
                    optional(
                        $pelamar->posisi
                    )->nama_posisi,

                    'Rumah Sakit' =>
                    optional(
                        $pelamar->rumahSakit
                    )->nama_rs,

                    'Status' =>
                    $pelamar->status_pelamar,

                    'CV' =>
                    $statusFile('cv'),

                    'Ijazah' =>
                    $statusFile('ijazah_transkrip'),

                    'KTP' =>
                    $statusFile('ktp'),

                    'Pas Foto' =>
                    $statusFile('pas_foto'),

                    'STR/SIP' =>
                    $statusFile('str_sip'),

                    'Sertifikat' =>
                    $statusFile('sertifikat'),

                    'Surat Pengalaman' =>
                    $statusFile('surat_pengalaman'),

                    'SKCK' =>
                    $statusFile('skck'),

                    'Surat Sehat' =>
                    $statusFile('surat_sehat'),

                    'Surat Pernyataan' =>
                    $statusFile('surat_pernyataan'),

                    'Surat Lamaran' =>
                    $statusFile('surat_lamaran'),

                    'Tidak Menuntut ASN' =>
                    $statusFile(
                        'surat_tidak_menuntut_diangkat_asn'
                    ),
                ];
            });
    }

    public function headings(): array
    {
        return [

            'Nomor Peserta',
            'Nama',
            'NIK',
            'Jenis Kelamin',
            'Jenis Pelamar',
            'Email',
            'No HP',
            'Kota Domisili',
            'Jenjang',
            'Alamat',
            'Pengalaman Kerja',
            'Ket. Pengalaman',
            'Catatan',
            'Posisi',
            'Rumah Sakit',
            'Status',

            'CV',
            'Ijazah',
            'KTP',
            'Pas Foto',
            'STR/SIP',
            'Sertifikat',
            'Surat Pengalaman',
            'SKCK',
            'Surat Sehat',
            'Surat Pernyataan',
            'Surat Lamaran',
            'Tidak Menuntut ASN',
        ];
    }

    public function styles(
        Worksheet $sheet
    ) {

        return [

            1 => [

                'font' => [

                    'bold' => true,

                    'color' => [
                        'rgb' => 'FFFFFF'
                    ]
                ],

                'fill' => [

                    'fillType' =>
                    Fill::FILL_SOLID,

                    'startColor' => [
                        'rgb' => '2563EB'
                    ]
                ]
            ]
        ];
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (
                AfterSheet $event
            ) {

                $sheet =
                    $event
                    ->sheet
                    ->getDelegate();

                /*
                |--------------------------------------------------------------------------
                | Freeze Header
                |--------------------------------------------------------------------------
                */

                $sheet->freezePane('A2');

                $highestRow =
                    $sheet
                    ->getHighestRow();

                /*
                |--------------------------------------------------------------------------
                | Status File Coloring
                |--------------------------------------------------------------------------
                */

                for (
                    $row = 2;
                    $row <= $highestRow;
                    $row++
                ) {

                    for (
                        $col = 17;
                        $col <= 28;
                        $col++
                    ) {

                        $columnLetter =
                            Coordinate
                            ::stringFromColumnIndex(
                                $col
                            );

                        $cell =
                            $columnLetter . $row;

                        $value =
                            $sheet
                            ->getCell($cell)
                            ->getValue();

                        if (
                            $value === '✔'
                        ) {

                            $sheet
                                ->getStyle($cell)
                                ->getFont()
                                ->getColor()
                                ->setRGB(
                                    '16A34A'
                                );
                        } elseif (
                            $value === '✘'
                        ) {

                            $sheet
                                ->getStyle($cell)
                                ->getFont()
                                ->getColor()
                                ->setRGB(
                                    'DC2626'
                                );
                        } elseif (
                            $value === '—'
                        ) {

                            $sheet
                                ->getStyle($cell)
                                ->getFont()
                                ->getColor()
                                ->setRGB(
                                    '6B7280'
                                );
                        }
                    }
                }
            }
        ];
    }
}
