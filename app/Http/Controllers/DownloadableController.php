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
    public function index()
    {
        return view('dashboard.downloadable.indexadmin');
    }

    public function user()
    {
        $downloadable = Downloadable::paginate(20);
        return view('dashboard.downloadable.index', compact('downloadable'));

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
    public function store(StoreDownloadableRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Downloadable $downloadable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Downloadable $downloadable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDownloadableRequest $request, Downloadable $downloadable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Downloadable $downloadable)
    {
        //
    }
}
