<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKurirRequest;
use App\Http\Requests\UpdateKurirRequest;

class KurirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian dari query string
        $search = $request->get('search');

        // Menambahkan pagination dan opsi per_page
        $perPage = $request->get('per_page', 10); // Default 10 per halaman

        // Jika ada pencarian, filter berdasarkan ekspedisi
        if ($search) {
            $kurir = Kurir::where('Ekspedisi', 'like', "%{$search}%")
                          ->latest()
                          ->paginate($perPage);
        } else {
            // Jika tidak ada pencarian, tampilkan semua data
            $kurir = Kurir::latest()->paginate($perPage);
        }

        return view('kurir.index', compact('kurir', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kurir.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKurirRequest $request)
    {
        $requestData = $request->validated();

        $kurir = new Kurir;
        $kurir->fill($requestData);
        $kurir->save();

        return redirect('/kurir')->with('success', 'Data Kurir berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kurir = Kurir::findOrFail($id);
        return view('kurir.edit', compact('kurir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurirRequest $request, string $id)
    {
        $requestData = $request->validated();

        $kurir = Kurir::findOrFail($id);
        $kurir->fill($requestData);
        $kurir->save();

        return redirect('/kurir')->with('success', 'Data Kurir berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kurir = Kurir::findOrFail($id);
        $kurir->delete();

        return redirect('/kurir')->with('success', 'Data Kurir berhasil dihapus!');
    }
}
