<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate(['ket_kategori' => 'required|unique:kategoris,ket_kategori']);
        Kategori::create($request->all());
        return back()->with('success', 'Kategori berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['ket_kategori' => 'required']);
        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
        return back()->with('success', 'Kategori berhasil diubah!');
    }

    public function destroy($id)
    {
        Kategori::destroy($id);
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}