<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Http\Requests\StoreLokasiRequest;
use App\Http\Requests\UpdateLokasiRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLokasiRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Lokasi $lokasi): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lokasi $lokasi): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLokasiRequest $request, Lokasi $lokasi): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lokasi $lokasi): RedirectResponse
    {
        //
    }
}
