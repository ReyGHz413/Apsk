<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Siswa;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Query dasar dengan Eager Loading agar ringan
        $query = Aspirasi::with(['siswa', 'kategori', 'tanggapan']);

        // Filter Per Tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Filter Per Bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', date('m', strtotime($request->bulan)))
                  ->whereYear('created_at', date('Y', strtotime($request->bulan)));
        }

        // Filter Per Siswa (NIS)
        if ($request->filled('nis')) {
            $query->where('nis', $request->nis);
        }

        // Filter Per Kategori
        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->id_kategori);
        }

        $aspirasis = $query->latest()->get();
        $kategoris = Kategori::all();
        $siswas = Siswa::all();

        return view('admin.dashboard', compact('aspirasis', 'kategoris', 'siswas'));
    }

    public function detail($id)
    {
        $aspirasi = Aspirasi::with(['siswa', 'kategori', 'tanggapan'])->findOrFail($id);
        return view('admin.detail', compact('aspirasi'));
    }

    public function berikanTanggapan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'required|string|max:200', // Sesuai ukk (1).sql varchar(200)
        ]);

        // Update atau Create tanggapan
        Tanggapan::updateOrCreate(
            ['id_aspirasi' => $id],
            [
                'status' => $request->status,
                'feedback' => $request->feedback,
                'id_kategori' => $request->id_kategori_hidden // Mengambil id_kategori dari aspirasi
            ]
        );

        return redirect()->route('admin.dashboard')->with('success', 'Tanggapan berhasil dikirim!');
    }
}