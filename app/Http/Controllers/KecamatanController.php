<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Http\Requests\StoreKecamatanRequest;
use App\Http\Requests\UpdateKecamatanRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class KecamatanController extends Controller
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
    public function store(StoreKecamatanRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kecamatan $kecamatan): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kecamatan $kecamatan): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKecamatanRequest $request, Kecamatan $kecamatan): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kecamatan $kecamatan): RedirectResponse
    {
        //
    }
}
