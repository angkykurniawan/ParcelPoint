<?php

namespace App\Http\Controllers;

use App\Models\kurir;
use App\Http\Requests\StorekurirRequest;
use App\Http\Requests\UpdatekurirRequest;

class KurirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kurir = Kurir::latest()->paginate(10);
        return view('kurir.index', compact('kurir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kurir.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorekurirRequest $request)
    {
        $requestData = $request->validate([
            'Ekspedisi' => 'required',
        ]);

        $kurir = new Kurir; //membuat objek kosong di variabel

        $kurir->fill($requestData); //mengisi var model dengan data yang sudah divalidasi

        $kurir->save(); //menyimpan data ke database
        return redirect('/kurir')->with('success', 'Data Kurir berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(kurir $kurir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kurir = Kurir::findOrFail($id);
        return view('kurir.edit', compact('kurir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekurirRequest $request, string $id)
    {
        $requestData = $request->validate([
            'Ekspedisi' => 'required',
        ]);
        $kurir = \App\Models\Kurir::findOrFail($id); //membuat objek kosong di variabel model
        $kurir->fill($requestData); //mengisi var model dengan data yang sudah divalidasi requestData

        $kurir->save(); //menyimpan data ke database
        return redirect('/kurir')->with('success', 'Data Kurir berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kurir = Kurir::findOrFail($id);

        $kurir->delete(); // Menghapus data pemilik
        return redirect('/kurir')->with('success', 'Data Kurir berhasil dihapus!');
    }
}
