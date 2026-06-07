<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\suratPaketController;
use App\Models\suratPaket;

class ResiController extends Controller
{
    public function searchResi(Request $request)
    {
        $request->validate([
            'resi' => 'required|string',
        ]);

        $resi = suratPaket::where('resi', $request->resi)
            ->join('pemiliks', 'surat_pakets.pemilik_id', '=', 'pemiliks.id')
            ->select('surat_pakets.jenis', 'pemiliks.Nama as pemilik', 'surat_pakets.status_daftar', 'surat_pakets.created_at', 'surat_pakets.WaktuJemput', 'surat_pakets.resi') // Pastikan resi dimasukkan di sini
            ->first();

        if ($resi) {
            return view('cekresi.index', compact('resi'));
        }

        return back()->with('error', 'Resi tidak ditemukan!');
    }
}
