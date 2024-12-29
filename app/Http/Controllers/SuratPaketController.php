<?php

namespace App\Http\Controllers;

use App\Models\kurir;
use App\Models\Pemilik;
use App\Models\suratPaket;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoresuratPaketRequest;
use App\Http\Requests\UpdatesuratPaketRequest;

class SuratPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratPaket = suratPaket::latest()->paginate(10);
        $Pemilik = Pemilik::latest()->paginate(10);
        $Kurir = kurir::latest()->paginate(10);
        return view('suratpaket.index', compact('suratPaket','Pemilik','Kurir'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Pemilik = Pemilik::latest()->paginate(10);
        $Kurir = kurir::latest()->paginate(10);
        return view('suratpaket.create', compact('Pemilik','Kurir'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresuratPaketRequest $request)
    {
        $requestData = $request->validate([
            'pemilik_id' => 'required|exists:pemiliks,id',
            'kurir_id' => 'required|exists:kurirs,id',
            'Jenis' => 'required|in:Surat,Paket',
            'Foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
            'NoHP' => 'required',
            'Resi' => 'required',
            'Berat' => 'nullable',
            'WaktuJemput' => 'nullable|date',
            'Penjemput' => 'nullable|in:YBS,Teman,Keluarga',
        ]);

        if ($request->hasFile('Foto')) {
            $requestData['Foto'] = $request->file('Foto')->store('public/suratpaket');
        }

        SuratPaket::create($requestData);

        return redirect('/suratPaket');
    }

    /**
     * Display the specified resource.
     */
    public function show(suratPaket $suratPaket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $suratPaket = suratPaket::findOrFail($id);
        $Pemilik = Pemilik::all();
        $Kurir = Kurir::all();
        return view('suratPaket.edit', compact('suratPaket','Pemilik','Kurir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesuratPaketRequest $request, string $id)
    {
        $requestData = $request->validate([
            'pemilik_id' => 'required|exists:pemiliks,id',
            'kurir_id' => 'required|exists:kurirs,id',
            'Jenis' => 'required',
            'Foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
            'NoHP' => 'required',
            'Resi' => 'required',
            'Berat' => 'nullable',
            'WaktuJemput' => 'nullable|date',
            'Penjemput' => 'nullable',
        ]);

        $suratPaket = \App\Models\suratPaket::findOrFail($id); //membuat objek kosong di variabel model
        $suratPaket->fill($requestData); //mengisi var model dengan data yang sudah divalidasi requestData

        if ($request->hasFile('Foto')) {
            Storage::delete($suratPaket->Foto);
            $suratPaket->Foto = $request->file('Foto')->store('public/suratPaket');
        }

        // $pasien->foto = $request->file('foto')->store('public');
        $suratPaket->save(); //menyimpan data ke database
        return redirect('/suratPaket');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suratPaket = suratPaket::findOrFail($id);
        if ($suratPaket->pemilik->count() >= 1) {
            return back();
        }
        if ($suratPaket->kurir->count() >= 1) {
            return back();
        }
        if ($suratPaket->Foto && Storage::exists($suratPaket->Foto)) {
            Storage::delete($suratPaket->Foto); // Menghapus gambar jika ada
        }
        $suratPaket->delete(); // Menghapus data pemilik
        return redirect('/suratPaket');
    }
}
