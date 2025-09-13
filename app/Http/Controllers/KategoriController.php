<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if ($keyword) {
            // Jika ada keyword, cari kategori berdasarkan nama_kategori atau keterangan
            $kategoris = Kategori::where('nama_kategori', 'like', '%' . $keyword . '%')
                                 ->orWhere('keterangan', 'like', '%' . $keyword . '%')
                                 ->get();
        } else {
            // Jika tidak ada keyword, tampilkan semua kategori
            $kategoris = Kategori::all();
        }

        return view('kategori_surat.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori_surat.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|unique:kategoris',
            'keterangan' => 'required|string',
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori_surat.form', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|unique:kategoris,nama_kategori,' . $kategori->id,
            'keterangan' => 'required|string',
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
