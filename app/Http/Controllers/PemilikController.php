<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePemilikRequest;
use App\Http\Requests\UpdatePemilikRequest;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Menambahkan pagination dan opsi per_page
        $perPage = $request->get('per_page', 10); // Default 10 per halaman
        $pemilik = Pemilik::latest()->paginate($perPage); // Menampilkan 10 pemilik per halaman

        return view('pemilik.index', compact('pemilik'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemilik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePemilikRequest $request)
    {
        $requestData = $request->validated();

        $pemilik = new Pemilik;
        $pemilik->fill($requestData);

        if ($request->hasFile('Foto')) {
            $pemilik->Foto = $request->file('Foto')->store('public/pemilik');
        }

        $pemilik->save();
        return redirect('/pemilik')->with('success', 'Data Pemilik berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $pemilik = Pemilik::findOrFail($id);
        return view('pemilik.edit', compact('pemilik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePemilikRequest $request, String $id)
    {
        $requestData = $request->validated();

        $pemilik = Pemilik::findOrFail($id);
        $pemilik->fill($requestData);

        if ($request->hasFile('Foto')) {
            Storage::delete($pemilik->Foto);
            $pemilik->Foto = $request->file('Foto')->store('public/pemilik');
        }

        $pemilik->save();
        return redirect('/pemilik')->with('success', 'Data Pemilik berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $pemilik = Pemilik::findOrFail($id);

        if ($pemilik->Foto && Storage::exists($pemilik->Foto)) {
            Storage::delete($pemilik->Foto);
        }

        $pemilik->delete();
        return redirect('/pemilik')->with('success', 'Data Pemilik berhasil dihapus!');
    }
}
