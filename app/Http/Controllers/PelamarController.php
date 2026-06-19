<?php

namespace App\Http\Controllers;

use App\Exports\PelamarExport;
use App\Models\Kuis;
use App\Models\Pelamar;
use App\Models\PelamarFile;
use App\Models\PengerjaanPelamar;
use App\Models\Posisi;
use App\Models\RumahSakit;
use App\Models\Soal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class PelamarController extends Controller
{
    public function tampil_halaman_pelamar()
    {
        $posisis = Posisi::get();
        $rumahSakits = RumahSakit::get();
        return view('welcome', compact('posisis', 'rumahSakits'));
    }

    // ======================
    // GENERATOR
    // ======================
    public static function generateUsername($nama)
    {
        return Str::slug($nama, '') . rand(100, 999);
    }

    public static function generatePassword()
    {
        return Str::random(8);
    }

    public static function generateNomorPeserta($data)
    {
        // =========================
        // MASTER
        // =========================

        $jenisPelamarMap = [
            'nakes' => 'N',
            'non_nakes' => 'NN',
        ];

        $pendidikanMap = [
            'SMA' => 1,
            'D3' => 2,
            'D4' => 3,
            'S1' => 4,
            'S2' => 5,
        ];

        // =========================
        // RS
        // =========================

        $rumahSakit = RumahSakit::findOrFail(
            $data['rumah_sakit_id']
        );

        $kodeRs = $rumahSakit->kode_rs;

        // =========================
        // JENIS TENAGA
        // =========================

        $kodeJenis =
            $jenisPelamarMap[$data['jenis_pelamar']] ?? 0;

        // =========================
        // PENDIDIKAN
        // =========================

        $kodePendidikan =
            $pendidikanMap[$data['jenjang']] ?? 0;

        // =========================
        // POSISI
        // =========================

        $posisi = Posisi::findOrFail(
            $data['id_posisi']
        );

        $kodePosisi = $posisi->kode_pelamar;

        // =========================
        // TAHUN
        // =========================

        $tahun = now()->format('Y');

        // =========================
        // PREFIX
        // =========================

        $prefix =
            $kodeRs . '.' .
            $kodeJenis . '.' .
            // $kodePendidikan . '.' .
            $kodePosisi;
        // $tahun;

        // =========================
        // NOMOR TERAKHIR
        // =========================

        $last = Pelamar::where(
            'nomer_peserta',
            'like',
            $prefix . '.%'
        )
            ->lockForUpdate()
            ->latest('id')
            ->first();

        $urutan = 1;

        if ($last) {

            $explode = explode('.', $last->nomer_peserta);

            $urutan = ((int) end($explode)) + 1;
        }

        // =========================
        // FORMAT 001
        // =========================

        $urutan = str_pad($urutan, 3, '0', STR_PAD_LEFT);

        return $prefix . '.' . $urutan;
    }

    // ======================
    // SIMPAN FILE (GENERIC)
    // ======================
    private function saveFile($pelamar, $file, $jenis)
    {
        $jenis = strtolower($jenis); // normalisasi

        $path = $file->store('pelamar_files', 'public');

        $pelamar->files()->create([
            'jenis_file' => $jenis,
            'file_path' => $path,
        ]);
    }

    // ======================
    // HANDLE MULTI FILE DINAMIS
    // ======================
    private function handleUploadFiles($request, $pelamar)
    {
        // mapping field => jenis_file
        $fields = [
            'cv' => 'cv',
            'ijazah' => 'ijazah',
            'skck' => 'skck',
        ];

        // file tunggal
        foreach ($fields as $input => $jenis) {
            if ($request->hasFile($input)) {
                $this->saveFile($pelamar, $request->file($input), $jenis);
            }
        }

        // multiple file (sertifikat)
        if ($request->hasFile('sertifikat')) {
            foreach ($request->file('sertifikat') as $file) {
                $this->saveFile($pelamar, $file, 'sertifikat');
            }
        }
    }

    // ======================
    // STORE
    // ======================

    public function store(Request $request)
    {
        DB::beginTransaction();

        $token = Str::uuid();

        try {

            // ======================
            // VALIDASI
            // ======================
            $validated = $request->validate([
                'id_posisi' => 'required|exists:posisis,id',
                'rumah_sakit_id' => 'required|exists:rumah_sakits,id',

                'nama' => 'required|string|max:255',

                'nik' => 'required|digits:16|unique:pelamars,nik',

                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',

                'jenis_pelamar' => 'required|in:nakes,non_nakes',

                'no_str' => [
                    'required_if:jenis_pelamar,nakes',
                    'nullable',
                    'string',
                    'max:50'
                ],

                'no_ijasah' => 'nullable|string|max:50',

                'email' => 'required|email|unique:pelamars,email',

                'jenjang' => 'required',

                'no_hp' => 'nullable|string|max:20',

                'kota_domisili' => 'nullable|string|max:100',

                'alamat' => 'nullable|string|max:255',

                'pengalaman_kerja' => 'nullable|string|max:255',

                'keterangan_pengalaman' => 'nullable|string',

                'tempat_lahir' => 'required|string|max:100',

                'tanggal_lahir' => 'required|date|before:today',

                'usia' => 'required|integer',

            ], [

                'id_posisi.required' => 'Posisi harus dipilih.',
                'id_posisi.exists' => 'Posisi tidak valid.',

                'rumah_sakit_id.required' => 'Rumah sakit harus dipilih.',
                'rumah_sakit_id.exists' => 'Rumah sakit tidak valid.',

                'nama.required' => 'Nama lengkap harus diisi.',

                'nik.required' => 'NIK harus diisi.',
                'nik.unique' => 'NIK sudah terdaftar.',
                'nik.digits' => 'NIK harus terdiri dari 16 digit.',

                'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
                'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',

                'jenis_pelamar.required' => 'Jenis pelamar harus dipilih.',
                'jenis_pelamar.in' => 'Jenis pelamar tidak valid.',

                'no_str.required_if' => 'No. STR/SIP wajib diisi untuk tenaga kesehatan.',

                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'tempat_lahir.required' => 'Tempat lahir harus diisi.',
                'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
                'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
                'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
                'usia.required' => 'Usia harus diisi.',
                'usia.integer' => 'Usia harus berupa angka.',
            ]);

            // ======================
            // VALIDASI POSISI SESUAI RS
            // ======================

            $posisi = Posisi::where('id', $validated['id_posisi'])
                ->where('id_rs', $validated['rumah_sakit_id'])
                ->first();

            if (!$posisi) {

                return response()->json([
                    'success' => false,
                    'errors' => [
                        'id_posisi' => [
                            'Posisi tidak tersedia pada rumah sakit yang dipilih.'
                        ]
                    ]
                ], 422);
            }

            if (
                $posisi->tanggal_ditutup &&
                Carbon::today()->gt(
                    Carbon::parse($posisi->tanggal_ditutup)
                )
            ) {

                return response()->json([
                    'success' => false,
                    'errors' => [
                        'id_posisi' => [
                            'Pendaftaran untuk posisi ini sudah ditutup.'
                        ]
                    ]
                ], 422);
            }

            // ======================
            // GENERATE USERNAME
            // ======================

            do {

                $username = self::generateUsername($validated['nama']);
            } while (
                Pelamar::where('username', $username)->exists()
            );

            // ======================
            // GENERATE NOMOR PESERTA
            // ======================

            do {

                $nomor_peserta = self::generateNomorPeserta($validated);
            } while (
                Pelamar::where('nomer_peserta', $nomor_peserta)->exists()
            );

            // ======================
            // GENERATE PASSWORD
            // ======================

            $password_plain = self::generatePassword();

            // ======================
            // SIMPAN DATA
            // ======================

            $pelamar = Pelamar::create([

                'id_posisi' => $validated['id_posisi'],

                // otomatis ambil dari posisi
                'rumah_sakit_id' => $posisi->id_rs,

                'nama' => $validated['nama'],

                'username' => $username,

                'nik' => $validated['nik'],

                'jenis_kelamin' => $validated['jenis_kelamin'],

                'jenis_pelamar' => $validated['jenis_pelamar'],

                'no_str' => $validated['no_str'],

                'no_ijasah' => $validated['no_ijasah'],

                'email' => $validated['email'],

                'password' => Hash::make($password_plain),

                'no_hp' => $validated['no_hp'],

                'kota_domisili' => $validated['kota_domisili'],

                'jenjang' => $validated['jenjang'],

                'alamat' => $validated['alamat'],

                'pengalaman_kerja' => $validated['pengalaman_kerja'],

                'keterangan_pengalaman' => $validated['keterangan_pengalaman'],

                'nomer_peserta' => $nomor_peserta,

                'tempat_lahir' => $validated['tempat_lahir'],

                'tanggal_lahir' => $validated['tanggal_lahir'],

                'usia' => $validated['usia'],

                'token' => $token,
            ]);

            // ======================
            // UPLOAD FILE
            // ======================

            // $this->handleUploadFiles($request, $pelamar);

            DB::commit();

            // ======================
            // SESSION
            // ======================

            session()->put('pelamar_auth', [
                'username' => $username,
                'password' => $password_plain,
                'nomor_peserta' => $nomor_peserta,
                'pelamar_id' => $pelamar->id
            ]);

            // ======================
            // RESPONSE
            // ======================

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil',

                'redirect' => route('Pelamar.hasil', $pelamar->token),

                'data' => [
                    'username' => $username,
                    'password' => $password_plain,
                    'nomor_peserta' => $nomor_peserta,
                ]
            ]);
        } catch (ValidationException $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server',

                // debug sementara
                // 'debug' => $e->getMessage()

            ], 500);
        }
    }
    public function hasil($token)
    {
        $pelamar = Pelamar::with(['posisi', 'files', 'rumahSakit'])
            ->where('token', $token)
            ->firstOrFail();

        return view('Pelamar.hasil', [
            'pelamar' => $pelamar,
            'username' => $pelamar->username,
            'nomor_peserta' => $pelamar->nomer_peserta,
        ]);
    }
    public function dash_it()
    {
        $user = Auth::user();

        $rsId = $user->rumah_sakit_id;

        // ─────────────────────────────
        // DATA UTAMA
        // ─────────────────────────────

        $pelamars = Pelamar::with([
            'posisi',
            'files',
            'rumahSakit'
        ])
            ->where('rumah_sakit_id', $rsId)
            ->latest()
            ->get();

        $posisis = Posisi::where(
            'id_rs',
            $rsId
        )
            ->get();

        $kuis = Kuis::with([
            'posisi',
            'soals',
            'pengerjaanPelamars'
        ])
            ->whereHas('posisi', function ($q)
            use ($rsId) {

                $q->where(
                    'id_rs',
                    $rsId
                );
            })
            ->latest()
            ->get();

        $soals = Soal::whereHas(
            'kuis.posisi',
            function ($q) use ($rsId) {

                $q->where(
                    'id_rs',
                    $rsId
                );
            }
        )
            ->get();

        $pengerjaanPelamars =
            PengerjaanPelamar::with([
                'pelamar',
                'kuis'
            ])
            ->whereHas(
                'pelamar',
                function ($q)
                use ($rsId) {

                    $q->where(
                        'rumah_sakit_id',
                        $rsId
                    );
                }
            )
            ->latest()
            ->get();

        // ─────────────────────────────
        // TREN PENDAFTARAN
        // ─────────────────────────────

        $trenLabels = [];
        $trenData   = [];

        for ($i = 11; $i >= 0; $i--) {

            $month =
                Carbon::now()
                ->subMonths($i);

            $trenLabels[] =
                $month
                ->translatedFormat(
                    'M Y'
                );

            $trenData[] =
                Pelamar::where(
                    'rumah_sakit_id',
                    $rsId
                )
                ->whereYear(
                    'created_at',
                    $month->year
                )
                ->whereMonth(
                    'created_at',
                    $month->month
                )
                ->count();
        }

        // ─────────────────────────────
        // PASS RATE KUIS
        // ─────────────────────────────

        $kuisLabels = [];
        $kuisPass   = [];

        foreach ($kuis->take(8) as $k) {

            $total =
                $k->pengerjaanPelamars
                ->count();

            $lulus =
                $k->pengerjaanPelamars
                ->where(
                    'status',
                    'lulus'
                )
                ->count();

            $kuisLabels[] =
                Str::limit(
                    $k->nama_kuis,
                    20
                );

            $kuisPass[] =
                $total > 0
                ? round(
                    ($lulus / $total)
                        * 100
                )
                : 0;
        }

        // ─────────────────────────────
        // STATISTIK
        // ─────────────────────────────

        $pending =
            $pelamars
            ->where(
                'status_pelamar',
                'pending'
            )
            ->count();

        $lolosBerkas =
            $pelamars
            ->where(
                'status_pelamar',
                'lolos_berkas'
            )
            ->count();

        $diterima =
            $pelamars
            ->where(
                'status_pelamar',
                'diterima'
            )
            ->count();

        $ditolak =
            $pelamars
            ->whereIn(
                'status_pelamar',
                [
                    'ditolak',
                    'tidak_lolos_berkas'
                ]
            )
            ->count();

        $pgPending =
            $pengerjaanPelamars
            ->where(
                'status',
                'pending'
            )
            ->count();

        $pgLulus =
            $pengerjaanPelamars
            ->where(
                'status',
                'lulus'
            )
            ->count();

        $pgGagal =
            $pengerjaanPelamars
            ->where(
                'status',
                'gagal'
            )
            ->count();

        return view(
            'IT.dashboard',
            compact(

                'pelamars',
                'posisis',
                'kuis',
                'soals',
                'pengerjaanPelamars',

                'trenLabels',
                'trenData',

                'kuisLabels',
                'kuisPass',

                'pending',
                'lolosBerkas',
                'diterima',
                'ditolak',

                'pgPending',
                'pgLulus',
                'pgGagal'
            )
        );
    }
    public function resetPassword(Request $request, string $token)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
            ],
        ]);

        DB::beginTransaction();
        try {
            $pelamar = Pelamar::where('token', $token)->firstOrFail();

            $pelamar->update([
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Password pelamar berhasil direset.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Terjadi kesalahan server.',
            ], 500);
        }
    }
    public function tampil_halaman_validasi(Request $request)
    {
        $user = auth()->user();

        $posisis = Posisi::where(
            'id_rs',
            $user->rumah_sakit_id
        )
            ->orderBy('nama_posisi')
            ->get();

        $pelamars = Pelamar::with([
            'posisi',
            'files',
            'rumahSakit'
        ])

            ->where(
                'rumah_sakit_id',
                $user->rumah_sakit_id
            )

            ->when(
                $request->id_posisi,
                function ($q) use ($request) {

                    $q->where(
                        'id_posisi',
                        $request->id_posisi
                    );
                }
            )

            ->when(
                $request->status,
                function ($q) use ($request) {

                    $q->where(
                        'status_pelamar',
                        $request->status
                    );
                }
            )

            ->latest()
            ->get();

        return view(
            'Pelamar.view',
            compact(
                'pelamars',
                'posisis'
            )
        );
    }
    public function exportExcel(Request $request)
    {
        $user = auth()->user();

        $tanggal = now()->format('Y-m-d');

        return Excel::download(

            new PelamarExport(

                $user,

                $request->id_posisi,

                $request->status

            ),

            "Pelamar_{$tanggal}.xlsx"

        );
    }
    public function validasi(Request $request, $token)
    {
        $request->validate([
            // 'status_pelamar' => 'required|in:lolos_berkas,tidak_lolos_berkas,diterima,ditolak',
            'status_pelamar' => 'required|in:diterima,ditolak',
            'catatan' => 'required|string'
        ]);

        DB::beginTransaction();

        try {
            $pelamar = Pelamar::where('token', $token)->firstOrFail();

            // ======================
            // VALIDASI FLOW
            // ======================
            $currentStatus = $pelamar->status_pelamar;
            $nextStatus    = $request->status_pelamar;

            if ($currentStatus === 'pending' && !in_array($nextStatus, ['diterima', 'ditolak'])) {
                throw new \Exception('Status sudah final');
            }
            // tahap 1
            // if ($currentStatus === 'pending' && !in_array($nextStatus, ['lolos_berkas', 'tidak_lolos_berkas'])) {
            //     throw new \Exception('Hanya bisa ke lolos/tidak lolos berkas');
            // }

            // // tahap 2
            // if ($currentStatus === 'lolos_berkas' && !in_array($nextStatus, ['diterima', 'ditolak'])) {
            //     throw new \Exception('Hanya bisa ke diterima/ditolak');
            // }

            // // final lock
            // if (in_array($currentStatus, ['diterima', 'ditolak'])) {
            //     throw new \Exception('Status sudah final');
            // }

            // ======================
            // UPDATE
            // ======================
            $pelamar->update([
                'status_pelamar' => $nextStatus,
                'catatan' => $request->catatan
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui',
                'status'  => $nextStatus
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Terjadi kesalahan server'
            ], 422);
        }
    }
    public function viewFile($id)
    {
        $file = PelamarFile::findOrFail($id);

        $path = storage_path('app/public/' . $file->file_path);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file($path);
    }
    public function detail_pelamar(string $token)
    {
        $pelamar = Pelamar::with(['posisi', 'files', 'rumahSakit'])
            ->where('token', $token)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data'    => [
                // Data Pribadi
                'nama'                    => $pelamar->nama,
                'nik'                     => $pelamar->nik,
                'username'                => $pelamar->username,
                'email'                   => $pelamar->email,
                'no_hp'                   => $pelamar->no_hp,
                'jenis_kelamin'           => $pelamar->jenis_kelamin,
                'kota_domisili'           => $pelamar->kota_domisili,
                'alamat'                  => $pelamar->alamat,
                'tempat_lahir'            => $pelamar->tempat_lahir,
                'tanggal_lahir'           => $pelamar->tanggal_lahir?->format('d M Y'),
                'usia'                    => $pelamar->usia,

                // Info Pendaftaran
                'nomer_peserta'           => $pelamar->nomer_peserta,
                'posisi_nama'             => $pelamar->posisi?->nama_posisi,
                'jenis_pelamar'           => $pelamar->jenis_pelamar,
                'jenjang'                 => $pelamar->jenjang,
                'no_str'                  => $pelamar->no_str,
                'status_pelamar'          => $pelamar->status_pelamar,

                // Pengalaman
                'pengalaman_kerja'        => $pelamar->pengalaman_kerja,
                'keterangan_pengalaman'   => $pelamar->keterangan_pengalaman,

                // Catatan & token
                'catatan'                 => $pelamar->catatan,
                'token'                   => $pelamar->token,

                // Waktu
                'created_at'              => $pelamar->created_at?->format('d M Y, H:i'),
                'updated_at'              => $pelamar->updated_at?->format('d M Y, H:i'),

                // Rumah Sakit
                'nama_rs'                => $pelamar->rumahSakit?->nama_rs,

                //

                // Berkas (files)
                'files' => $pelamar->files->map(fn($f) => [
                    'id'         => $f->id,
                    'jenis_file' => $f->jenis_file,
                ])->values(),
            ],
        ]);
    }
    private const JENIS_FILE = [
        'cv'                    => ['label' => 'Curriculum Vitae (CV)',              'icon' => 'fa-user',             'required' => true, 'hint' => 'PDF  · Maks. 1 MB'],
        'ijazah_transkrip'      => ['label' => 'Ijazah & Transkrip Nilai',           'icon' => 'fa-graduation-cap',   'required' => true, 'hint' => 'PDF  · Maks. 1 MB'],
        'ktp'                   => ['label' => 'Fotokopi KTP',                       'icon' => 'fa-id-card',          'required' => true, 'hint' => 'PDF  · Maks. 1 MB'],
        'pas_foto'              => ['label' => 'Pas Foto Terbaru',                   'icon' => 'fa-image',            'required' => true, 'hint' => 'JPEG/PNG  · Maks. 1 MB'],
        'str_sip'               => ['label' => 'STR (Wajib bagi Tenaga Kesehatan)',             'icon' => 'fa-file-medical',     'required' => false, 'hint' => 'PDF  · Maks. 1 MB'],
        'sertifikat'            => ['label' => 'Sertifikat Pelatihan (Boleh Lebih dari 1)',  'icon' => 'fa-certificate',      'required' => false, 'hint' => 'PDF  · Maks. 1 MB'],
        'surat_pengalaman'      => ['label' => 'Surat Pengalaman Kerja',             'icon' => 'fa-briefcase',        'required' => false, 'hint' => 'PDF  · Maks. 1 MB'],
        'skck'                  => ['label' => 'SKCK',                               'icon' => 'fa-shield-halved',    'required' => true, 'hint' => 'PDF  · Maks. 1 MB'],
        'surat_sehat'           => ['label' => 'Surat Keterangan Sehat',             'icon' => 'fa-stethoscope',      'required' => true, 'hint' => 'PDF  · Maks. 1 MB'],
        'surat_pernyataan'      => ['label' => 'Surat Pernyataan Keaslian Dokumen', 'icon' => 'fa-file-signature',   'required' => true, 'hint' => 'PDF  · Maks. 1 MB'],
        'surat_lamaran'         => ['label' => 'Surat Lamaran Pekerjaan',            'icon' => 'fa-file-signature',   'required' => true, 'hint' => 'PDF  · Maks. 1 MB'],
        'surat_tidak_menuntut_diangkat_asn'         => ['label' => 'Surat Pernyataan Tidak Menuntut Diangkat ASN',            'icon' => 'fa-file-signature',   'required' => true, 'hint' => 'PDF  · Maks. 1 MB'],


    ];

    private function resolveJenisFile(string $jenisPelamar): array
    {
        return collect(self::JENIS_FILE)
            ->map(function (array $meta, string $key) use ($jenisPelamar) {
                if ($key === 'str_sip') {
                    $meta['required'] = ($jenisPelamar === 'nakes');
                }
                return $meta;
            })
            ->toArray();
    }
    // ══════════════════════════════════════════
    //  DASHBOARD — tampilan utama pelamar
    // ══════════════════════════════════════════
    public function dashboard_pelamar()
    {
        /** @var \App\Models\Pelamar $pelamar */
        $pelamar = Auth::guard('pelamar')->user();
        $pelamar->load(['posisi', 'files', 'pengerjaanPelamars.kuis']);

        $uploadedFiles  = $pelamar->files->keyBy('jenis_file');
        $jenisFile = $this->resolveJenisFile($pelamar->jenis_pelamar);

        // hitung kelengkapan berkas
        $required  = collect($jenisFile)->where('required', true)->keys();
        $uploaded  = $uploadedFiles->keys();
        $complete  = $required->filter(fn($k) => $uploaded->contains($k))->count();
        $progress  = $required->count() > 0 ? round(($complete / $required->count()) * 100) : 0;

        // data pengerjaan kuis
        $pengerjaanList = $pelamar->pengerjaanPelamars->map(fn($p) => [
            'nama_kuis' => $p->kuis->nama_kuis ?? '-',
            'nilai'     => $p->nilai,
            'status'    => $p->status,
        ]);

        return view('Pelamar.dashboard', compact(
            'pelamar',
            'uploadedFiles',
            'jenisFile',
            'progress',
            'complete',
            'pengerjaanList'
        ));
    }

    // ══════════════════════════════════════════
    //  UPLOAD — unggah / ganti satu file
    // ══════════════════════════════════════════
    public function upload(Request $request)
    {
        $request->validate([
            'jenis_file' => ['required', 'string', 'in:' . implode(',', array_keys(self::JENIS_FILE))],
            'file'       => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:1024'], // 1 MB
        ], [
            'file.mimes' => 'Format file harus PDF atau gambar.',
            'file.max'   => 'Ukuran file maksimal 1 MB.',
        ]);

        $pelamar  = Auth::guard('pelamar')->user();
        $posisi = $pelamar->posisi;
        if (
            $posisi &&
            $posisi->tanggal_ditutup &&
            Carbon::today()->gt(
                Carbon::parse($posisi->tanggal_ditutup)
            )
        ) {

            return response()->json([

                'success' => false,

                'message' =>
                'Upload file tidak dapat dilakukan karena masa pendaftaran telah berakhir.'

            ], 422);
        }

        $jenis    = $request->jenis_file;
        $existing = PelamarFile::where('pelamar_id', $pelamar->id)
            ->where('jenis_file', $jenis)->first();

        // hapus file lama jika ada
        if ($existing && Storage::disk('public')->exists($existing->file_path)) {
            Storage::disk('public')->delete($existing->file_path);
        }

        // simpan file baru
        $path = $request->file('file')->store("pelamar_files/{$pelamar->id}", 'public');

        // updateOrCreate record
        $file = PelamarFile::updateOrCreate(
            ['pelamar_id' => $pelamar->id, 'jenis_file' => $jenis],
            ['file_path'  => $path]
        );

        return response()->json([
            'success' => true,
            'message' => self::JENIS_FILE[$jenis]['label'] . ' berhasil diunggah.',
            'data'    => [
                'id'         => $file->id,
                'jenis_file' => $file->jenis_file,
                'url'        => asset('storage/' . $file->file_path),
                'ext'        => pathinfo($path, PATHINFO_EXTENSION),
            ],
        ]);
    }

    // ══════════════════════════════════════════
    //  DELETE — hapus satu file
    // ══════════════════════════════════════════
    public function deleteFile($jenis)
    {
        $pelamar = Auth::guard('pelamar')->user();

        $posisi = $pelamar->posisi;

        if (
            $posisi &&
            $posisi->tanggal_ditutup &&
            Carbon::today()->gt(
                Carbon::parse($posisi->tanggal_ditutup)
            )
        ) {

            return response()->json([
                'success' => false,
                'message' => 'File tidak dapat dihapus karena masa pendaftaran telah berakhir.'
            ], 422);
        }

        if (!array_key_exists($jenis, self::JENIS_FILE)) {
            return response()->json([
                'success' => false,
                'message' => 'Jenis file tidak valid.'
            ], 422);
        }

        $file = PelamarFile::where('pelamar_id', $pelamar->id)
            ->where('jenis_file', $jenis)
            ->first();

        if (!$file) {
            return response()->json([
                'success' => false,
                'message' => 'File tidak ditemukan.'
            ], 404);
        }

        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }

        $file->delete();

        return response()->json([
            'success' => true,
            'message' => self::JENIS_FILE[$jenis]['label'] . ' berhasil dihapus.',
        ]);
    }

    // ══════════════════════════════════════════
    //  TAMBAH JENIS FILE KUSTOM (oleh admin)s
    //  — route ini diproteksi role SDM/IT
    // ══════════════════════════════════════════
    public static function getAllJenis(): array
    {
        return self::JENIS_FILE;
    }
}
