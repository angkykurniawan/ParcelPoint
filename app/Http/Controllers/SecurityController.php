<?php

namespace App\Http\Controllers;

use App\Models\security;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoresecurityRequest;
use App\Http\Requests\UpdatesecurityRequest;

class SecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $security = Security::latest()->paginate(10);
        return view('security.index', compact('security'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('security.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresecurityRequest $request)
    {
        $requestData = $request->validate([
            'NIP' => 'required',
            'Nama' => 'required',
            'Foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
            'NoHP' => 'required',
            'Email' => 'required',
        ]);

        $security = new Security; //membuat objek kosong di variabel

        $security->fill($requestData); //mengisi var model dengan data yang sudah divalidasi

        if ($request->hasFile('Foto')) {
            $security->Foto = $request->file('Foto')->store('public/security'); // Menyimpan file gambar
        }

        $security->save(); //menyimpan data ke database
        return redirect('/security');
    }

    /**
     * Display the specified resource.
     */
    public function show(security $security)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $security = Security::findOrFail($id);
        return view('security.edit', compact('security'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesecurityRequest $request, string $id)
    {
        $requestData = $request->validate([
            'NIP' => 'required',
            'Nama' => 'required',
            'Foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
            'NoHP' => 'required',
            'Email' => 'required',
        ]);

        $security = \App\Models\Security::findOrFail($id); //membuat objek kosong di variabel model
        $security->fill($requestData); //mengisi var model dengan data yang sudah divalidasi requestData

        if ($request->hasFile('Foto')) {
            Storage::delete($security->Foto);
            $security->Foto = $request->file('Foto')->store('public/security');
        }

        // $pasien->foto = $request->file('foto')->store('public');
        $security->save(); //menyimpan data ke database
        return redirect('/security');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $security = Security::findOrFail($id);

        if ($security->Foto && Storage::exists($security->Foto)) {
            Storage::delete($security->Foto); // Menghapus gambar jika ada
        }

        $security->delete(); // Menghapus data pemilik
        return redirect('/security');
    }
}
