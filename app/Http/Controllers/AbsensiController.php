<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal', date('Y-m-d'));
        $mataKuliahId = $request->input('mata_kuliah_id');

        $listMataKuliah = Matakuliah::all();
        $mahasiswa = Mahasiswa::all();

        // Ambil data absensi berdasarkan tanggal (dan mata_kuliah_id jika ada)
        $query = Absensi::where('tanggal_absensi', $tanggal);
        if ($mataKuliahId) {
            $query->where('matakuliah_id', $mataKuliahId);
        }

        $absensiExisting = $query->get()->keyBy('mahasiswa_id');

        return view('absensi.index', compact('listMataKuliah', 'mahasiswa', 'tanggal', 'mataKuliahId', 'absensiExisting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'   => 'required|date',
            'kehadiran' => 'required|array',
        ]);

        foreach ($request->kehadiran as $mahasiswaId => $status) {
            Absensi::updateOrCreate(
                [
                    'tanggal_absensi' => $request->tanggal,
                    'mahasiswa_id'    => $mahasiswaId,
                    'matakuliah_id'   => $request->mata_kuliah_id ?? null,
                ],
                [
                    'status_absen'    => $status
                ]
            );
        }

        return redirect()->back()->with('success', 'Data absensi berhasil disimpan!');
    }
}