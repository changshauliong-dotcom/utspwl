<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim'  => 'required|unique:mahasiswas,nim',
            'nama' => 'required',
        ]);

        Mahasiswa::create([
            'nim'  => $request->nim,
            'nama' => $request->nama,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'nim'  => 'required|unique:mahasiswas,nim,' . $id,
            'nama' => 'required',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);$mahasiswa->update([
            'nim'  => $request->nim,
            'nama' => $request->nama,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Mahasiswa::destroy($id);
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus!');
    }
}