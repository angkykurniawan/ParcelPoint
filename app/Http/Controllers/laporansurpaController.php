<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class laporansurpaController extends Controller
{
    public function create()
    {
        $data['listSurpa'] = \App\Models\suratPaket::orderBy('Resi', 'asc')->get();
        $data['listPemilik'] = \App\Models\Pemilik::orderBy('Nama', 'asc')->pluck('Nama', 'id');
        return view('laporansurpa.create', $data);
    }

    public function index(Request $request)
    {
        $models = \App\Models\suratPaket::query();

        // Memfilter berdasarkan tanggal_mulai
        if ($request->filled('tanggal_mulai')) {
            $tanggalMulai = Carbon::parse($request->tanggal_mulai)->startOfDay();
            $models->where('created_at', '>=', $tanggalMulai);
        }

        // Memfilter berdasarkan tanggal_akhir
        if ($request->filled('tanggal_akhir')) {
            $tanggalAkhir = Carbon::parse($request->tanggal_akhir)->endOfDay();
            $models->where('created_at', '<=', $tanggalAkhir);
        }

        // Memfilter berdasarkan pemilik
        if ($request->filled('pemilik_id')) {
            $models->where('pemilik_id', '=', $request->pemilik_id);
        }

        // Memfilter berdasarkan status_daftar
        if ($request->filled('status_daftar')) {
            $models->where('status_daftar', '=', $request->status_daftar);
        }

        // Mengambil data terbaru dengan pagination
        $data['models'] = $models->latest()->paginate(5);

        return view('laporansurpa.index', $data);
    }

    public function cetak(Request $request)
    {
        $models = \App\Models\suratPaket::query();

        if ($request->filled('tanggal_mulai')) {
            $tanggalMulai = Carbon::parse($request->tanggal_mulai)->startOfDay();
            $models->where('created_at', '>=', $tanggalMulai);
        }

        if ($request->filled('tanggal_akhir')) {
            $tanggalAkhir = Carbon::parse($request->tanggal_akhir)->endOfDay();
            $models->where('created_at', '<=', $tanggalAkhir);
        }

        if ($request->filled('pemilik_id')) {
            $models->where('pemilik_id', '=', $request->pemilik_id);
        }

        if ($request->filled('status_daftar')) {
            $models->where('status_daftar', '=', $request->status_daftar);
        }

        // Mengambil semua data tanpa pagination agar keluar semua di kertas cetak
        $data['models'] = $models->latest()->get();

        $data['tanggal_mulai'] = $request->tanggal_mulai;
        $data['tanggal_akhir'] = $request->tanggal_akhir;

        return view('laporansurpa.cetak', $data);
    }
}
