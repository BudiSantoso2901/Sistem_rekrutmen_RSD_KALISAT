<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelamar;

class ScanController extends Controller
{
    /**
     * Halaman scan barcode admin.
     */
    public function index()
    {
        return view('IT.Scan');
    }

    /**
     * Proses hasil scan — cari pelamar berdasarkan token atau nomer_peserta.
     * Menerima query string ?q=... dari AJAX atau redirect.
     */
    public function cari(Request $request)
    {
        $q = trim($request->input('q', ''));

        if (empty($q)) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Kode scan tidak boleh kosong.'], 422);
            }
            return redirect()->route('admin.scan.index')->with('error', 'Kode scan tidak boleh kosong.');
        }

        // Cari berdasarkan token ATAU nomer_peserta
        $pelamar = Pelamar::with(['posisi', 'files', 'rumahSakit'])
            ->where('token', $q)
            ->orWhere('nomer_peserta', $q)
            ->first();

        if (!$pelamar) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pelamar tidak ditemukan. Pastikan kode/barcode valid.',
                ], 404);
            }
            return redirect()->route('admin.scan.index')
                ->with('scan_error', 'Pelamar tidak ditemukan untuk kode: ' . $q);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success'  => true,
                'redirect' => route('admin.scan.hasil', $pelamar->token),
            ]);
        }

        return redirect()->route('admin.scan.hasil', $pelamar->token);
    }

    /**
     * Halaman hasil detail pelamar setelah scan.
     */
    public function hasil(string $token)
    {
        $pelamar = Pelamar::with(['posisi', 'files', 'rumahSakit', 'pengerjaanPelamars.kuis'])
            ->where('token', $token)
            ->firstOrFail();

        // Hitung kelengkapan berkas
        $jenisFileWajib = [
            'cv',
            'ijazah_transkrip',
            'ktp',
            'pas_foto',
            'skck',
            'surat_sehat',
            'surat_pernyataan',
            'surat_lamaran',
            'surat_tidak_menuntut_diangkat_asn',
        ];
        if ($pelamar->jenis_pelamar === 'nakes') {
            $jenisFileWajib[] = 'str_sip';
        }

        $uploadedKeys = $pelamar->files->pluck('jenis_file')->toArray();
        $totalWajib   = count($jenisFileWajib);
        $totalUpload  = count(array_intersect($jenisFileWajib, $uploadedKeys));
        $progress     = $totalWajib > 0 ? round(($totalUpload / $totalWajib) * 100) : 0;

        // Data kuis
        $pengerjaanList = $pelamar->pengerjaanPelamars->map(fn($p) => [
            'nama_kuis' => $p->kuis->nama_kuis ?? '-',
            'nilai'     => $p->nilai,
            'status'    => $p->status,
            'id'        => $p->id,
        ]);

        return view('IT.Hasil', compact(
            'pelamar',
            'progress',
            'totalWajib',
            'totalUpload',
            'pengerjaanList',
        ));
    }
}
