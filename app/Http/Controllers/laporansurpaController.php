<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class laporansurpaController extends Controller
{
    public function create(){
        $data['listSurpa'] = \App\Models\suratPaket::orderBy('Resi', 'asc')->get();
        $data['listPemilik'] = \App\Models\Pemilik::orderBy('Nama', 'asc')->pluck('Nama', 'id');
        return view('laporansurpa.create', $data);
    }

    public function index(Request $request){
        $models = \App\Models\suratPaket::query();

        // Memfilter berdasarkan tanggal_mulai
        if ($request->filled('tanggal_mulai')) {
            $tanggalMulai = Carbon::parse($request->tanggal_mulai)->startOfDay(); // Memulai hari
            $models->where('created_at', '>=', $tanggalMulai);
        }

        // Memfilter berdasarkan tanggal_akhir
        if ($request->filled('tanggal_akhir')) {
            $tanggalAkhir = Carbon::parse($request->tanggal_akhir)->endOfDay(); // Mengakhiri hari
            $models->where('created_at', '<=', $tanggalAkhir);
        }

        // Memfilter berdasarkan pemilik
        if ($request->filled('pemilik_id')) {
            $models->where('pemilik_id', '=', $request->pemilik_id);
        }

        // Mengambil data dengan urutan terbaru dan paginate
        $data['models'] = $models->latest()->paginate(2); // Gunakan paginate untuk membatasi hasil
        return view('laporansurpa.index', $data);
    }
}
