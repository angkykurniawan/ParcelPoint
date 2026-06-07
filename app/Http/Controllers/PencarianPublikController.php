<?php

namespace App\Http\Controllers;

use App\Models\suratPaket;
use Illuminate\Http\Request;

class PencarianPublikController extends Controller
{
    public function index(Request $request)
    {
        $paket = null;

        if ($request->has('resi') && $request->input('resi') != '') {
            $keyword = trim($request->input('resi'));

            $paket = suratPaket::with(['Pemilik', 'Ruang', 'Kurir'])
                ->where('Resi', 'LIKE', '%' . $keyword . '%')
                ->latest()
                ->first();
        }

        elseif ($request->has('owner') && $request->input('owner') != '') {
            $keyword = trim($request->input('owner'));

            $paket = suratPaket::with(['Pemilik', 'Ruang', 'Kurir'])
                ->whereHas('Pemilik', function($query) use ($keyword) {
                    $query->where('Nama', 'LIKE', '%' . $keyword . '%');
                })
                ->latest()
                ->first();
        }

        return view('welcome', compact('paket'));
    }
}
