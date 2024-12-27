<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use App\Http\Requests\StorePemilikRequest;
use App\Http\Requests\UpdatePemilikRequest;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pemilik.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePemilikRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemilik $pemilik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemilik $pemilik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePemilikRequest $request, Pemilik $pemilik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemilik $pemilik)
    {
        //
    }
}
