<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use App\Models\Posisi;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KuisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kuis = Kuis::with(['posisi', 'user', 'soals'])
                ->latest()
                ->get()
                ->map(fn($k) => [
                    'id'          => $k->id,
                    'nama_kuis'   => $k->nama_kuis,
                    'posisi'      => $k->posisi?->nama_posisi ?? '-',
                    'waktu'       => $k->waktu,
                    'deskripsi'   => $k->deskripsi,
                    'total_soal'  => $k->soals->count(),
                    'dibuat_oleh' => $k->user?->name ?? '-',
                    'created_at'  => $k->created_at->format('Y-m-d'),
                ]);

            return response()->json($kuis);
        }

        $posisis = Posisi::latest()->get();
        return view('IT.Kuis', compact('posisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kuis'  => 'required|string|max:255',
            'posisi_id'  => 'required|exists:posisis,id',
            'waktu'      => 'required|integer|min:1',
            'deskripsi'  => 'nullable|string',
        ]);

        $kuis = Kuis::updateOrCreate(
            ['id' => $request->id],
            [
                'nama_kuis'   => $request->nama_kuis,
                'posisi_id'   => $request->posisi_id,
                'waktu'       => $request->waktu,
                'deskripsi'   => $request->deskripsi,
                'dibuat_oleh' => Auth::id(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => $request->id ? 'Kuis berhasil diperbarui' : 'Kuis berhasil ditambahkan',
            'data'    => $kuis,
        ]);
    }
    public function show($id)
    {
        $kuis = Kuis::with(['soals', 'posisi'])->findOrFail($id);
        return response()->json($kuis);
    }


    public function destroy($id)
    {
        $kuis = Kuis::with('soals')->findOrFail($id);

        // hapus foto soal dari storage
        foreach ($kuis->soals as $soal) {
            if ($soal->foto_soal) {
                Storage::disk('public')->delete($soal->foto_soal);
            }
        }

        $kuis->delete(); // cascade soals via DB constraint / observer

        return response()->json(['success' => true, 'message' => 'Kuis berhasil dihapus']);
    }
    public function soalPage($id)
    {
        $kuis = Kuis::with('soals')->findOrFail($id);
        return view('IT.soal', compact('kuis'));
    }

    public function soalIndex(Request $request, $kuisId)
    {
        $soals = Soal::where('id_kuis', $kuisId)->latest()->get();
        return response()->json($soals);
    }
    public function soalStore(Request $request, $kuisId)
    {
        Kuis::findOrFail($kuisId); // pastikan kuis ada

        $request->validate([
            'pertanyaan'    => 'required|string',
            'jawaban_a'     => 'required|string|max:255',
            'jawaban_b'     => 'required|string|max:255',
            'jawaban_c'     => 'required|string|max:255',
            'jawaban_d'     => 'required|string|max:255',
            'jawaban_benar' => 'required|in:a,b,c,d',
            'foto_soal'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['pertanyaan', 'jawaban_a', 'jawaban_b', 'jawaban_c', 'jawaban_d', 'jawaban_benar']);
        $data['id_kuis'] = $kuisId;

        // upload foto jika ada
        if ($request->hasFile('foto_soal')) {
            // hapus foto lama jika update
            if ($request->soal_id) {
                $old = Soal::find($request->soal_id);
                if ($old?->foto_soal) Storage::disk('public')->delete($old->foto_soal);
            }
            $data['foto_soal'] = $request->file('foto_soal')->store('soal_images', 'public');
        }

        $soal = Soal::updateOrCreate(
            ['id' => $request->soal_id],
            $data
        );

        return response()->json([
            'success' => true,
            'message' => $request->soal_id ? 'Soal berhasil diperbarui' : 'Soal berhasil ditambahkan',
            'data'    => $soal,
        ]);
    }

    public function soalDestroy($kuisId, $soalId)
    {
        $soal = Soal::where('id_kuis', $kuisId)->findOrFail($soalId);
        if ($soal->foto_soal) Storage::disk('public')->delete($soal->foto_soal);
        $soal->delete();

        return response()->json(['success' => true, 'message' => 'Soal berhasil dihapus']);
    }
    public function duplicate(Request $request, $id)
    {
        $request->validate([
            'nama_kuis' => 'required|string|max:255',
            'posisi_id' => 'required|exists:posisis,id',
            'waktu'     => 'required|integer|min:1',
            'copy_soal' => 'boolean',
        ]);

        $original = Kuis::with('soals')->findOrFail($id);

        DB::beginTransaction();
        try {
            // 1. buat kuis baru
            $newKuis = Kuis::create([
                'nama_kuis'   => $request->nama_kuis,
                'posisi_id'   => $request->posisi_id,
                'waktu'       => $request->waktu,
                'deskripsi'   => $original->deskripsi,
                'dibuat_oleh' => Auth::id(),
            ]);

            // 2. salin soal jika diminta
            if ($request->boolean('copy_soal', true)) {
                foreach ($original->soals as $soal) {
                    $newFoto = null;

                    // duplikat file foto jika ada
                    if ($soal->foto_soal && Storage::disk('public')->exists($soal->foto_soal)) {
                        $ext     = pathinfo($soal->foto_soal, PATHINFO_EXTENSION);
                        $newPath = 'soal_images/' . uniqid('soal_', true) . '.' . $ext;
                        Storage::disk('public')->copy($soal->foto_soal, $newPath);
                        $newFoto = $newPath;
                    }

                    Soal::create([
                        'id_kuis'       => $newKuis->id,
                        'pertanyaan'    => $soal->pertanyaan,
                        'jawaban_a'     => $soal->jawaban_a,
                        'jawaban_b'     => $soal->jawaban_b,
                        'jawaban_c'     => $soal->jawaban_c,
                        'jawaban_d'     => $soal->jawaban_d,
                        'jawaban_benar' => $soal->jawaban_benar,
                        'foto_soal'     => $newFoto,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success'    => true,
                'message'    => 'Kuis berhasil disalin dengan ' . ($request->boolean('copy_soal', true) ? $original->soals->count() . ' soal' : '0 soal (tanpa soal)'),
                'data'       => $newKuis->load('soals'),
                'total_soal' => $request->boolean('copy_soal', true) ? $original->soals->count() : 0,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Gagal menyalin kuis: ' . $e->getMessage()], 500);
        }
    }
}
