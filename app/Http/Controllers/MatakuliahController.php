<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index()
    {
        $matakuliah = Matakuliah::all();
        return view('matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'            => 'required',
            'nama_matakuliah' => 'required',
        ]);

        Matakuliah::create($request->all());

        return redirect()->route('matakuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode'            => 'required',
            'nama_matakuliah' => 'required',
        ]);

        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->update($request->all());

        return redirect()->route('matakuliah.index')->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')->with('success', 'Mata Kuliah berhasil dihapus.');
    }
}