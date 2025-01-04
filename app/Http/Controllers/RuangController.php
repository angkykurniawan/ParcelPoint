<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRuangRequest;
use App\Http\Requests\UpdateRuangRequest;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian dari query string
        $search = $request->get('search');

        // Menambahkan pagination dan opsi per_page
        $perPage = $request->get('per_page', 1); // Default 10 per halaman

        // Jika ada pencarian, filter berdasarkan nama ruang
        if ($search) {
            $ruang = Ruang::where('Nama', 'like', "%{$search}%")
                          ->orWhere('Lokasi', 'like', "%{$search}%")
                          ->latest()
                          ->paginate($perPage);
        } else {
            // Jika tidak ada pencarian, tampilkan semua data
            $ruang = Ruang::latest()->paginate($perPage);
        }

        return view('ruang.index', compact('ruang', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ruang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRuangRequest $request)
    {
        $requestData = $request->validate([
            'Nama' => 'required',
            'Lantai' => 'nullable|numeric',
            'Lokasi' => 'nullable',
            'PIC' => 'nullable',
        ]);

        $ruang = new Ruang;
        $ruang->fill($requestData);

        $ruang->save();
        return redirect('/ruang')->with('success', 'Data Ruang berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruang = Ruang::findOrFail($id);
        return view('ruang.edit', compact('ruang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRuangRequest $request, string $id)
    {
        $requestData = $request->validate([
            'Nama' => 'required',
            'Lantai' => 'nullable|numeric',
            'Lokasi' => 'nullable',
            'PIC' => 'nullable',
        ]);

        $ruang = Ruang::findOrFail($id);
        $ruang->fill($requestData);

        $ruang->save();
        return redirect('/ruang')->with('success', 'Data Ruang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ruang = Ruang::findOrFail($id);
        $ruang->delete();
        return redirect('/ruang')->with('success', 'Data Ruang berhasil dihapus!');
    }
}
