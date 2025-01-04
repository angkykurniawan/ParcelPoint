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
        $perPage = $request->get('per_page', 1); // Default 10 per halaman

        // Jika ada pencarian, filter berdasarkan ekspedisi
        $kurir = Kurir::when($search, function ($query, $search) {
            return $query->where('Ekspedisi', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate($perPage);

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
        // Validate the request and get the validated data
        $requestData = $request->validate([
            'Ekspedisi'=> 'required',
        ]);

        // Create a new Kurir instance and fill it with the validated data
        $kurir = new Kurir;
        $kurir->fill($requestData);
        $kurir->save(); // Save the new Kurir to the database

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
        // Validating the incoming request
        $requestData = $request->validate([
            'Ekspedisi'=> 'required',
        ]);

        // Find the Kurir entry by ID and update it with new data
        $kurir = Kurir::findOrFail($id);
        $kurir->fill($requestData);
        $kurir->save(); // Save the updated Kurir entry to the database

        // Redirecting with a success message
        return redirect('/kurir')->with('success', 'Data Kurir berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find and delete the Kurir entry
        $kurir = Kurir::findOrFail($id);
        $kurir->delete();

        // Redirecting with a success message
        return redirect('/kurir')->with('success', 'Data Kurir berhasil dihapus!');
    }
}
