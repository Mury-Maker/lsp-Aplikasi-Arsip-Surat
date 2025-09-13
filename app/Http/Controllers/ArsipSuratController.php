<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class ArsipSuratController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if ($keyword) {
            $surats = Surat::with('kategori')->where('judul', 'like', '%' . $keyword . '%')->get();
        } else {
            $surats = Surat::with('kategori')->get();
        }

        return view('arsip_surat', compact('surats'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('arsip_surat_create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surats',
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required',
            'file_surat' => 'required|mimes:pdf|max:2048',
        ]);

        $filePath = $request->file('file_surat')->store('surat_files', 'public');

        Surat::create([
            'nomor_surat' => $request->nomor_surat,
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'file_path' => $filePath,
            'waktu_pengarsipan' => now(),
        ]);

        return redirect()->route('arsip.index')->with('success', 'Surat berhasil diarsipkan.');
    }

    public function destroy($id)
    {
        $surat = Surat::find($id);
        if ($surat) {
            if (Storage::disk('public')->exists(str_replace('public/', '', $surat->file_path))) {
                Storage::disk('public')->delete(str_replace('public/', '', $surat->file_path));
            }
            $surat->delete();
            return redirect()->route('arsip.index')->with('success', 'Surat berhasil dihapus.');
        }
        return redirect()->route('arsip.index')->with('error', 'Surat tidak ditemukan.');
    }

    public function download($id)
    {
        $surat = Surat::find($id);
        $filePath = str_replace('public/', '', $surat->file_path);
        if ($surat && Storage::disk('public')->exists($filePath)) {
            return response()->download(Storage::disk('public')->path($filePath), $surat->judul . '.pdf');
        }
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    public function view($id)
    {
        $surat = Surat::with('kategori')->find($id);
        if (!$surat) {
            return redirect()->route('arsip.index')->with('error', 'Surat tidak ditemukan.');
        }
        return view('arsip_surat_view', compact('surat'));
    }

    public function about()
    {
        return view('about');
    }
}
