<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HewanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hewans = Hewan::latest()->get();
        return view('hewan.index', compact('hewans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hewan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_hewan' => 'required',
            'jenis' => 'required',
            'umur' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image'
        ]);

        $gambar = $request->file('gambar')->store('hewan', 'public');

        Hewan::create([
            'nama_hewan' => $request->nama_hewan,
            'jenis' => $request->jenis,
            'umur' => $request->umur,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar
        ]);

        return redirect()->route('hewan.index')->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $hewan = Hewan::findOrFail($id);
        return view('hewan.show', compact('hewan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $hewan = Hewan::findOrFail($id);
        return view('hewan.edit', compact('hewan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $hewan = Hewan::findOrFail($id);

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($hewan->gambar);

            $gambar = $request->file('gambar')->store('hewan', 'public');
        } else {
            $gambar = $hewan->gambar;
        }

        $hewan->update([
            'nama_hewan' => $request->nama_hewan,
            'jenis' => $request->jenis,
            'umur' => $request->umur,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar
        ]);

        return redirect()->route('hewan.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        
        $hewan = Hewan::findOrFail($id);

        Storage::disk('public')->delete($hewan->gambar);

        $hewan->delete();

        return redirect()->route('hewan.index')->with('success', 'Data berhasil dihapus');
    }
}