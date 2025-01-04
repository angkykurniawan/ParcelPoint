<?php

namespace App\Http\Controllers;

use Log;
use CURLFile;
use App\Models\Kurir;
use App\Models\Ruang;
use App\Models\Pemilik;
use App\Models\SuratPaket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSuratPaketRequest;
use App\Http\Requests\UpdateSuratPaketRequest;

class SuratPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Use $request->input() to retrieve input values
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $suratPaket = SuratPaket::with('Pemilik')
            ->when($search, function ($query, $search) {
                return $query->where('Resi', 'like', "%{$search}%")
                             ->orWhereHas('Pemilik', function ($query) use ($search) {
                                 $query->where('Nama', 'like', "%{$search}%");
                             });
            })
            ->latest()
            ->paginate($perPage);

        $Pemilik = Pemilik::latest()->paginate(10);
        $Kurir = Kurir::latest()->paginate(10);
        $Ruang = Ruang::latest()->paginate(10);

        return view('suratpaket.index', compact('suratPaket', 'Pemilik', 'Kurir', 'Ruang', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Pemilik = Pemilik::latest()->paginate(10);
        $Kurir = Kurir::latest()->paginate(10);
        $Ruang = Ruang::latest()->paginate(10);
        return view('suratpaket.create', compact('Pemilik', 'Kurir', 'Ruang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuratPaketRequest $request)
    {
        $requestData = $request->validate([
            'pemilik_id' => 'required|exists:pemiliks,id',
            'kurir_id' => 'required|exists:kurirs,id',
            'ruang_id' => 'required|exists:ruangs,id',
            'Jenis' => 'required|in:Surat,Paket',
            'Foto' => 'required|image|mimes:jpeg,png,jpg|max:2000',
            'NoHP' => 'required|numeric',
            'Resi' => 'required',
            'Berat' => 'nullable|numeric',
            'WaktuJemput' => 'nullable|date',
            'Penjemput' => 'nullable|in:YBS,Teman,Keluarga',
        ]);

        $requestData['Penginput'] = Auth::user()->name;

        if ($request->hasFile('Foto')) {
            $requestData['Foto'] = $request->file('Foto')->store('public/suratpaket');
        }

        SuratPaket::create($requestData);

        return redirect('/suratPaket')->with('success', 'Data Surat Paket berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $suratPaket = SuratPaket::findOrFail($id);
        return view('suratpaket.show', ['suratPaket' => $suratPaket]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $suratPaket = SuratPaket::findOrFail($id);
        $Pemilik = Pemilik::all();
        $Kurir = Kurir::all();
        $Ruang = Ruang::all();
        return view('suratPaket.edit', compact('suratPaket', 'Pemilik', 'Kurir', 'Ruang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuratPaketRequest $request, $id)
    {
        $requestData = $request->validate([
            'WaktuJemput' => 'required|date',
            'Penjemput' => 'required|in:YBS,Teman,Keluarga',
            'FotoST' => 'required|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $requestData['Pengupdate'] = Auth::user()->name;


        $suratPaket = SuratPaket::findOrFail($id);
        $suratPaket->fill($requestData);

        if ($request->hasFile('FotoST')) {
            if ($suratPaket->FotoST && Storage::exists($suratPaket->FotoST)) {
                Storage::delete($suratPaket->FotoST);
            }

            $suratPaket->FotoST = $request->file('FotoST')->store('public/suratpaket/fotoST');
        }

        $suratPaket->status_daftar = 'Sudah Dijemput';
        $suratPaket->save();

        return redirect('/suratPaket')->with('success', 'Data berhasil diperbarui dan status sudah dijemput');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suratPaket = SuratPaket::findOrFail($id);

        if ($suratPaket->Foto && Storage::exists($suratPaket->Foto)) {
            Storage::delete($suratPaket->Foto);
        }

        $suratPaket->delete();

        return redirect('/suratPaket')->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Function Cek Resi
     */
    public function cekResi($resi)
    {
        return SuratPaket::where('resi', $resi)
            ->select('jenis', 'pemilik', 'statusDaftar', 'created_at', 'WaktuJemput', 'resi')
            ->first();
    }
}
