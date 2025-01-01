<?php

namespace App\Http\Controllers;

use Log;
use CURLFile;
use App\Models\kurir;
use App\Models\Ruang;
use App\Models\Pemilik;
use App\Models\suratPaket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
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
        $Ruang = Ruang::latest()->paginate(10);
        return view('suratpaket.index', compact('suratPaket', 'Pemilik', 'Kurir', 'Ruang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Pemilik = Pemilik::latest()->paginate(10);
        $Kurir = kurir::latest()->paginate(10);
        $Ruang = Ruang::latest()->paginate(10);
        return view('suratpaket.create', compact('Pemilik', 'Kurir', 'Ruang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresuratPaketRequest $request)
    {
        $requestData = $request->validate([
            'pemilik_id' => 'required|exists:pemiliks,id',
            'kurir_id' => 'required|exists:kurirs,id',
            'ruang_id' => 'required|exists:ruangs,id',
            'Jenis' => 'required|in:Surat,Paket',
            'Foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
            'NoHP' => 'required',
            'Resi' => 'required',
            'Berat' => 'nullable',
            'WaktuJemput' => 'nullable|date',
            'Penjemput' => 'nullable|in:YBS,Teman,Keluarga',
        ]);

        // Menambahkan nama user yang sedang login ke dalam requestData
        $requestData['Penginput'] = Auth::user()->name;

        if ($request->hasFile('Foto')) {
            $requestData['Foto'] = $request->file('Foto')->store('public/suratpaket');
        }

        SuratPaket::create($requestData);
        $suratPaket = new suratPaket();

        $tanggalDaftar = new \DateTime($suratPaket->created_at);
        $hariIni = new \DateTime();
        $selisih = $tanggalDaftar->diff($hariIni);

        if ($selisih->days === 0) {
            $suratPaket->status = 'DiterimaSecurity';
        }

        return redirect('/suratPaket')->with('success', 'Data Surat Paket berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $suratPaket = suratPaket::findOrFail($id);
        return view('suratpaket.show', [
            'suratPaket' => $suratPaket,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $suratPaket = suratPaket::findOrFail($id);
        $Pemilik = Pemilik::all();
        $Kurir = Kurir::all();
        $Ruang = Ruang::all();
        return view('suratPaket.edit', compact('suratPaket', 'Pemilik', 'Kurir', 'Ruang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesuratPaketRequest $request, $id)
    {
        // Validasi data dari request
        $requestData = $request->validate([
            'WaktuJemput' => 'required|date',
            'Penjemput' => 'required|in:YBS,Teman,Keluarga',
            'FotoST' => 'required|image|mimes:jpeg,png,jpg|max:2000', // Validasi file FotoST
        ]);

        // Temukan suratPaket berdasarkan ID
        $suratPaket = SuratPaket::findOrFail($id);

        // Perbarui data suratPaket dengan data dari request
        $suratPaket->fill($requestData);

        // Jika ada file FotoST yang diupload, simpan dan perbarui data FotoST
        if ($request->hasFile('FotoST')) {
            // Periksa apakah ada foto lama dan hapus jika ada
            if ($suratPaket->FotoST && Storage::exists($suratPaket->FotoST)) {
                Storage::delete($suratPaket->FotoST); // Hapus foto lama
            }

            // Menyimpan foto baru dan update kolom FotoST
            $suratPaket->FotoST = $request->file('FotoST')->store('public/suratpaket/fotoST');
        }

        // Ubah status_daftar menjadi 'Sudah Dijemput'
        $suratPaket->status_daftar = 'Sudah Dijemput';

        // Simpan perubahan ke database
        $suratPaket->save();

        // Redirect ke halaman suratPaket dengan pesan sukses
        return redirect('/suratPaket')->with('success', 'Data berhasil diperbarui dan status sudah dijemput');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Mencari SuratPaket berdasarkan ID
    $suratPaket = suratPaket::findOrFail($id);

    // Menghapus file Foto jika ada
    if ($suratPaket->Foto && Storage::exists($suratPaket->Foto)) {
        Storage::delete($suratPaket->Foto); // Menghapus gambar jika ada
    }

    // Menghapus data suratPaket dari database
    $suratPaket->delete(); // Menghapus data suratPaket

    // Redirect kembali ke halaman suratPaket setelah berhasil dihapus
    return redirect('/suratPaket')->with('success', 'Data berhasil dihapus!');
}
}
