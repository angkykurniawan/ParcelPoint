<?php

namespace App\Http\Controllers;

use App\Models\suratPaket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PencarianPublikController extends Controller
{
    public function index(Request $request)
    {
        $paket = null;

        if ($request->filled('resi')) {
            $keyword = trim($request->input('resi'));

            $paket = suratPaket::with(['Pemilik', 'Ruang', 'Kurir'])
                ->where('Resi', '=', $keyword) 
                ->latest()
                ->first();
        }

        if ($request->filled('owner')) {
            $keyword = trim($request->input('owner'));

            $paket = suratPaket::with(['Pemilik', 'Ruang', 'Kurir'])
                ->whereHas('Pemilik', function($query) use ($keyword) {
                    $query->where(DB::raw('LOWER(Nama)'), 'LIKE', '%' . strtolower($keyword) . '%');
                })
                ->latest()
                ->first();
        }

        return view('welcome', compact('paket'));
    }
}
