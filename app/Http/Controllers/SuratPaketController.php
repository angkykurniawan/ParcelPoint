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
use App\Models\EmailHistory;
use App\Models\WhatsappHistory;
use Carbon\Carbon;

class SuratPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve input values
        $search = $request->input('search');
        $perPage = $request->input('per_page', 2);
        $selectedDate = $request->input('date');
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');
        $selectedJenis = $request->input('jenis');

        $suratPaket = SuratPaket::with('Pemilik')
            ->when($search, function ($query, $search) {
                return $query->where('Resi', 'like', "%{$search}%")
                    ->orWhereHas('Pemilik', function ($query) use ($search) {
                        $query->where('Nama', 'like', "%{$search}%");
                    });
            })
            ->when($selectedDate, function ($query, $selectedDate) {
                return $query->whereDate('created_at', $selectedDate);
            })
            ->when($selectedMonth, function ($query, $selectedMonth) {
                return $query->whereMonth('created_at', $selectedMonth);
            })
            ->when($selectedYear, function ($query, $selectedYear) {
                return $query->whereYear('created_at', $selectedYear);
            })
            ->orderByDesc('created_at')
            ->paginate($perPage);

        return view('SuratPaket.index', compact('suratPaket', 'search', 'selectedDate', 'selectedMonth', 'selectedYear'));
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

        // Convert WaktuJemput to Y-m-d format if provided, otherwise leave as is
        if ($request->has('WaktuJemput') && $request->input('WaktuJemput')) {
            $requestData['WaktuJemput'] = Carbon::createFromFormat('d-m-Y', $request->input('WaktuJemput'))->format('Y-m-d'); // Convert to Y-m-d for storage
        }

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

        // Format date for display
        if ($suratPaket->WaktuJemput) {
            $suratPaket->WaktuJemput = Carbon::parse($suratPaket->WaktuJemput)->format('d-m-Y'); // Format to d-m-Y
        }

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
            'WaktuJemput' => 'nullable|date',
            'Penjemput' => 'nullable|in:YBS,Teman,Keluarga',
            'FotoST' => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        // Menangani data dengan trim untuk memastikan tidak ada spasi ekstra
        $requestData['Penjemput'] = filter_var(trim($request->input('Penjemput')), FILTER_SANITIZE_STRING);

        // Proses update
        $suratPaket = SuratPaket::findOrFail($id);
        $suratPaket->fill($requestData);

        // Menangani tanggal
        if ($request->has('WaktuJemput') && !empty($request->input('WaktuJemput'))) {
            $suratPaket->WaktuJemput = Carbon::parse($request->input('WaktuJemput'))->format('Y-m-d H:i:s');
        }

        // Menangani Foto Serah Terima jika ada
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

    public function searchOwner(Request $request)
    {
        $request->validate([
            'owner' => 'required|string',
        ]);

        $search = $request->input('owner');
        $suratPaket = SuratPaket::with('Pemilik')
            ->whereHas('Pemilik', function ($query) use ($search) {
                $query->where('Nama', 'like', "%{$search}%");
            })
            ->get();

        return view('searchResults', compact('suratPaket'));
    }

    public function history($id)
    {
        $suratPaket = SuratPaket::findOrFail($id);

        // Ambil 15 riwayat WhatsApp dan Email
        $whatsappHistory = WhatsappHistory::take(15)->get();  // Mengambil 15 data teratas dari WhatsAppHistory
        $emailHistory = EmailHistory::take(15)->get();        // Mengambil 15 data teratas dari EmailHistory

        return view('suratPaket.history', compact('whatsappHistory', 'emailHistory', 'suratPaket'));
    }
}
