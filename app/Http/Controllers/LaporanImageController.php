<?php

namespace App\Http\Controllers;

use App\Models\LaporanImage;
use App\Http\Requests\StoreLaporanImageRequest;
use App\Http\Requests\UpdateLaporanImageRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class LaporanImageController extends Controller
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
    public function store(StoreLaporanImageRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanImage $laporanImage): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanImage $laporanImage): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaporanImageRequest $request, LaporanImage $laporanImage): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanImage $laporanImage): RedirectResponse
    {
        //
    }
}
