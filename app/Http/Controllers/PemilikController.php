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
        return view('poli_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePemilikRequest $request)
    {
        $requestData = $request->validate([
            'Nomor Induk' => 'required',
            'Nama' => 'required',
            'Umur' => 'nullable',
            'Pekerjaan' => 'required',
            'Whatsapp' => 'required',
            'Email' => 'required',
            'Foto' => 'nullable',
            'Jalan' => 'nullable',
            'Kecamatan' => 'nullable',
            'KabupatenKota' => 'required',
            'Pronvisi' => 'required',
        ]);
        $pemilik = new Pemilik();
        $pemilik->fill($requestData);
        $pemilik->Foto = $request->file('Foto')->store('public');
        $pemilik->save();
        return redirect('/pemilik')->with('success', 'Data pemilik berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemilik $pemilik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data['pemilik'] = \App\Models\Pemilik::findOrFail($id);
        return view('pemilik_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePemilikRequest $request, String $id)
    {
        $requestData = $request->validate([
            'Nomor Induk' => 'required',
            'Nama' => 'required',
            'Umur' => 'nullable',
            'Pekerjaan' => 'required',
            'Whatsapp' => 'required',
            'Email' => 'required',
            'Foto' => 'nullable',
            'Jalan' => 'nullable',
            'Kecamatan' => 'nullable',
            'KabupatenKota' => 'required',
            'Pronvisi' => 'required',
            ]);
        $pemilik = \App\Models\Pemilik::findOrfail($id);
        $pemilik->fill($requestData);
        if($request->hasFile('Foto')){
            Storage::delete($pemilik->Foto);
            $pemilik->Foto = $request->file('Foto')->store('public');
        }
        $pemilik->save();
        return redirect('/pemilik');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $pemilik = \App\Models\Pemilik::findOrfail($id);
        // if ($pemilik->surpa->count() >= 1) {
        //     flash('Data tidak bisa dihapus karena sudah terkait dengan data pendaftaran')->error();
        //     return back();
        // }
        if ($pemilik->Foto != null && Storage::exists($pemilik->Foto)) {
            Storage::delete($pemilik->Foto);
        }
        $pemilik->delete();
        return redirect('/pemilik');
    }
}
