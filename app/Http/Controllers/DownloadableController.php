<?php

namespace App\Http\Controllers;

use App\Models\Downloadable;
use App\Http\Requests\StoreDownloadableRequest;
use App\Http\Requests\UpdateDownloadableRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class DownloadableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function user(): Response
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
    public function store(StoreDownloadableRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Downloadable $downloadable): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Downloadable $downloadable): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDownloadableRequest $request, Downloadable $downloadable): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Downloadable $downloadable): RedirectResponse
    {
        //
    }
}
