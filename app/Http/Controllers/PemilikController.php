<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePemilikRequest;
use App\Http\Requests\UpdatePemilikRequest;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemilik = Pemilik::latest()->paginate(10);
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
        // Validasi input data
        $requestData = $request->validate([
            'NomorInduk' => 'required',
            'Nama' => 'required',
            'Umur' => 'nullable|integer',
            'Pekerjaan' => 'required|in:Mahasiswa,Dosen,Staff',
            'Whatsapp' => 'required',
            'Email' => 'required|email',
            'JenisKelamin' => 'required|in:LakiLaki,Perempuan',
            'Foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
            'Jalan' => 'nullable',
            'Kecamatan' => 'nullable',
            'KabupatenKota' => 'required',
            'Provinsi' => 'required',
        ]);

        $pemilik = new Pemilik; //membuat objek kosong di variabel

        $pemilik->fill($requestData); //mengisi var model dengan data yang sudah divalidasi

        if ($request->hasFile('Foto')) {
            $pemilik->Foto = $request->file('Foto')->store('public/pemilik'); // Menyimpan file gambar
        }

        $pemilik->save(); //menyimpan data ke database
        return redirect('/pemilik');
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
        $requestData = $request->validate([
            'NomorInduk' => 'required',
            'Nama' => 'required',
            'Umur' => 'nullable|integer',
            'Pekerjaan' => 'required|in:Mahasiswa,Dosen,Staff',
            'Whatsapp' => 'required',
            'Email' => 'required|email',
            'JenisKelamin' => 'required|in:LakiLaki,Perempuan',
            'Foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
            'Jalan' => 'nullable',
            'Kecamatan' => 'nullable',
            'KabupatenKota' => 'required',
            'Provinsi' => 'required',
        ]);
        $pemilik = \App\Models\Pemilik::findOrFail($id); //membuat objek kosong di variabel model
        $pemilik->fill($requestData); //mengisi var model dengan data yang sudah divalidasi requestData

        if ($request->hasFile('Foto')) {
            Storage::delete($pemilik->Foto);
            $pemilik->Foto = $request->file('Foto')->store('public/pemilik');
        }

        // $pasien->foto = $request->file('foto')->store('public');
        $pemilik->save(); //menyimpan data ke database
        return redirect('/pemilik');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $pemilik = Pemilik::findOrFail($id);

        if ($pemilik->Foto && Storage::exists($pemilik->Foto)) {
            Storage::delete($pemilik->Foto); // Menghapus gambar jika ada
        }

        $pemilik->delete(); // Menghapus data pemilik
        return redirect('/pemilik');
    }
}
