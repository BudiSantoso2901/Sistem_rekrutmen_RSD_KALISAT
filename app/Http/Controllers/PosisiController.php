<?php

namespace App\Http\Controllers;

use App\Models\Posisi;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PosisiController extends Controller
{
    // 🔥 READ (list + single)
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Posisi::with('rumahSakit')
                ->latest()
                ->get()
                ->map(function ($item) {

                    return [
                        'id' => $item->id,

                        'nama_posisi' => $item->nama_posisi,

                        'kode_pelamar' => $item->kode_pelamar,

                        'deskripsi_posisi' => $item->deskripsi_posisi,

                        'tanggal_ditutup' => $item->tanggal_ditutup,

                        'id_rs' => $item->id_rs,

                        'nama_rs' => $item->rumahSakit->nama_rs ?? '-',

                        'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                    ];
                });

            return response()->json($data);
        }

        return view('IT.Posisi', [
            'rumahSakits' => RumahSakit::orderBy('nama_rs')->get()
        ]);
    }

    // 🔥 CREATE + UPDATE (1 function)
    public function store(Request $request)
    {
        $request->validate(
            [
                'id_rs' => 'required|exists:rumah_sakits,id',
                'nama_posisi' => 'required|string|max:255',
                'deskripsi_posisi' => 'nullable|string',
                'tanggal_ditutup' => 'nullable|date',
                'kode_pelamar' => [
                    'required',
                    'string',
                    'max:255',
                ],
            ],
            [
                'nama_posisi.required' => 'Nama posisi wajib diisi.',
                'kode_pelamar.required' => 'Kode pelamar wajib diisi.',
                'kode_pelamar.unique' => 'Kode pelamar sudah digunakan. Harap gunakan kode lain.',
            ]
        );

        $posisi = Posisi::updateOrCreate(
            ['id' => $request->id],
            [
                'nama_posisi' => $request->nama_posisi,
                'deskripsi_posisi' => $request->deskripsi_posisi,
                'tanggal_ditutup' => $request->tanggal_ditutup,
                'kode_pelamar' => $request->kode_pelamar,
                'id_rs' => $request->id_rs,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => $request->id ? 'Berhasil update posisi' : 'Berhasil tambah posisi',
            'data' => $posisi
        ]);
    }

    // 🔥 DELETE
    public function destroy($id)
    {
        Posisi::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Posisi berhasil dihapus'
        ]);
    }
}
