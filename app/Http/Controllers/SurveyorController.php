<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Status;
use App\Models\Laporan;
use App\Models\Komentar;
use Illuminate\View\View;
use App\Models\Notifikasi;
use App\Models\LaporanImage;
use App\Models\CategoryAduan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SurveyorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = CategoryAduan::all();
        $laporan = Laporan::orderBy('created_at', 'desc')->paginate(20);
        $statuses = Status::all();
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                    ->where('status', true)
                    ->count();

        return view('dashboard.surveyor.index', compact('category','laporan','statuses', 'notifikasi', 'jumlahnotif'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laporan = Laporan::find($id);
        $user = User::find($laporan->user_id);
        $userName = $user->name;
        $statuses = Status::all();
        $images = LaporanImage::where('laporan_id', $laporan->id)->get();
        $komentar = Komentar::with('status')->where('laporan_id', $laporan->id)->orderBy('updated_at', 'desc')->get();
        
        $notifikasi = Notifikasi::where('user_id', 1)
        ->orderByDesc('created_at')
        ->paginate(15);
    
        $jumlahnotif = Notifikasi::where('user_id', 1)
            ->where('status', true)
            ->count();
        
        if(auth()->user()->role === 'admin' || auth()->user()->role === 'surveyor') {
            return view('dashboard.surveyor.edit', compact('laporan','userName','statuses','images','komentar', 'notifikasi', 'jumlahnotif'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
