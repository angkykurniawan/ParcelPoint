<?php

namespace App\Http\Controllers;

use App\Models\security;
use App\Http\Requests\StoresecurityRequest;
use App\Http\Requests\UpdatesecurityRequest;

class SecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoresecurityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(security $security)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(security $security)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesecurityRequest $request, security $security)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(security $security)
    {
        //
    }
}
