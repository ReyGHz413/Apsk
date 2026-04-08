<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    // Dashboard Siswa: Menampilkan riwayat milik siswa yang login
    public function siswaDashboard()
    {
        $nis = Auth::guard('siswa')->user()->nis;
        
        $aspirasis = Aspirasi::where('nis', $nis)
                    ->with(['kategori', 'tanggapan'])
                    ->latest()
                    ->get();

        return view('siswa.dashboard', compact('aspirasis'));
    }

    // Halaman Form Input
    public function create()
    {
        $kategoris = Kategori::all();
        return view('siswa.input', compact('kategoris'));
    }

    // Simpan Pengaduan
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'lokasi' => 'required|max:50',
            'ket' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload Foto
        $nama_foto = time() . "_" . $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('upload_aspirasi'), $nama_foto);

        // Simpan ke Tabel Aspirasis
        $aspirasi = Aspirasi::create([
            'nis' => Auth::guard('siswa')->user()->nis,
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
            'ket' => $request->ket,
            'foto' => $nama_foto,
        ]);

        // Buat Tanggapan Awal (Status: Menunggu)
        Tanggapan::create([
            'id_aspirasi' => $aspirasi->id,
            'status' => 'Menunggu',
            'id_kategori' => $request->id_kategori,
            'feedback' => '-',
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Pengaduan berhasil dikirim!');
    }

    // Detail Aspirasi untuk Siswa
    public function detail($id)
    {
        $aspirasi = Aspirasi::with(['kategori', 'tanggapan'])->findOrFail($id);
        
        // Pastikan siswa hanya bisa melihat detail miliknya sendiri
        if ($aspirasi->nis != Auth::guard('siswa')->user()->nis) {
            return redirect()->route('siswa.dashboard')->with('error', 'Akses dilarang!');
        }

        return view('siswa.detail', compact('aspirasi'));
    }
}