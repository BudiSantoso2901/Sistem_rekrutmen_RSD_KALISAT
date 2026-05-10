<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PengerjaanPelamar;
use App\Models\Pelamar;
use App\Models\Kuis;
use Illuminate\Http\Request;

class HasilKuisController extends Controller
{
    /**
     * Daftar semua pengerjaan kuis pelamar.
     */
    public function index(Request $request)
    {
        $query = PengerjaanPelamar::with(['pelamar', 'kuis'])
            ->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by kuis
        if ($request->filled('kuis_id')) {
            $query->where('id_kuis', $request->kuis_id);
        }

        // Search by nama pelamar
        if ($request->filled('search')) {
            $query->whereHas('pelamar', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $pengerjaans = $query->paginate(15);
        $pengerjaans->appends($request->all());
        $kuisList    = Pelamar::orderBy('nama')->get();

        // Statistik ringkasan
        $stats = [
            'total'   => PengerjaanPelamar::count(),
            'pending' => PengerjaanPelamar::where('status', 'pending')->count(),
            'lulus'   => PengerjaanPelamar::where('status', 'lulus')->count(),
            'gagal'   => PengerjaanPelamar::where('status', 'gagal')->count(),
        ];

        return view('IT.hasil_kuis', compact('pengerjaans', 'kuisList', 'stats'));
    }

    /**
     * Detail pengerjaan kuis beserta jawaban pelamar.
     */
    public function show(PengerjaanPelamar $pengerjaanPelamar)
    {
        $pengerjaan = $pengerjaanPelamar->load([
            'pelamar',
            'kuis',
            'jawabanPelamars.soal',
        ]);

        // Kelompokkan jawaban per nomor soal (urut)
        $jawabanList = $pengerjaan->jawabanPelamars->sortBy('soal_id');

        $totalSoal  = $jawabanList->count();
        $totalBenar = $jawabanList->where('benar', true)->count();
        $totalSalah = $totalSoal - $totalBenar;

        return view('IT.show_hasil', compact(
            'pengerjaan',
            'jawabanList',
            'totalSoal',
            'totalBenar',
            'totalSalah'
        ));
    }

    /**
     * Update status pengerjaan (lulus / gagal) secara manual oleh admin.
     */
    public function updateStatus(Request $request, PengerjaanPelamar $pengerjaanPelamar)
    {
        $request->validate([
            'status' => ['required', 'in:pending,lulus,gagal'],
        ]);

        $pengerjaanPelamar->update(['status' => $request->status]);

        return back()->with('success', 'Status pengerjaan berhasil diperbarui.');
    }

    /**
     * Hapus data pengerjaan (opsional — hanya jika diperlukan).
     */
    public function destroy(PengerjaanPelamar $pengerjaanPelamar)
    {
        $pengerjaanPelamar->jawabanPelamars()->delete();
        $pengerjaanPelamar->delete();

        return redirect()->route('sdm.hasil-kuis.index')
            ->with('success', 'Data pengerjaan berhasil dihapus.');
    }
}
