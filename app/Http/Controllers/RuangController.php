<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Http\Requests\StoreRuangRequest;
use App\Http\Requests\UpdateRuangRequest;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruang = Ruang::latest()->paginate(10);
        return view('ruang.index', compact('ruang'));
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
            'Lantai' => 'nullable',
            'Lokasi' => 'nullable',
            'PIC' => 'nullable',
        ]);

        $ruang = new Ruang; //membuat objek kosong di variabel

        $ruang->fill($requestData); //mengisi var model dengan data yang sudah divalidasi

        $ruang->save(); //menyimpan data ke database
        return redirect('/ruang')->with('success', 'Data Ruang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruang $ruang)
    {
        //
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
            'Lantai' => 'nullable',
            'Lokasi' => 'nullable',
            'PIC' => 'nullable',
        ]);
        $ruang = \App\Models\Ruang::findOrFail($id); //membuat objek kosong di variabel model
        $ruang->fill($requestData); //mengisi var model dengan data yang sudah divalidasi requestData

        $ruang->save(); //menyimpan data ke database
        return redirect('/ruang')->with('success', 'Data Ruang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ruang = Ruang::findOrFail($id);

        $ruang->delete(); // Menghapus data pemilik
        return redirect('/ruang')->with('success', 'Data Ruang berhasil dihapus!');
    }
}
