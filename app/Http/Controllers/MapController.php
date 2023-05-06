<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Laporan;
use App\Models\Komentar;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Models\CategoryAduan;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    public function index()
    {
        $laporan = Laporan::with('status')->get();
        $status = Status::all();
        $komentar = Komentar::all();
        $category = CategoryAduan::all();
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                    ->where('status', true)
                    ->count();
        return view('dashboard/map',  compact('laporan','status','category', 'komentar','notifikasi', 'jumlahnotif'));
    }

    public function home()
    {
        $laporan = Laporan::with('status')->get();
        $status = Status::all();
        $komentar = Komentar::all();
        $category = CategoryAduan::all();

        return view('home.index',  compact('laporan','status','category', 'komentar'));
    }

}
