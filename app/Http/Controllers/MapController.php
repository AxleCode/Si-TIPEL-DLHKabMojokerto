<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Status;
use App\Models\Laporan;
use App\Models\Komentar;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Models\CategoryAduan;
use App\Models\Pelayanan;
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
        $pelayanan = Pelayanan::orderBy('nomor', 'asc')->get();
        $komentar = Komentar::all();
        $category = CategoryAduan::all();
        $logo_utama = Logo::find(1);
        $logo_kedua = Logo::find(2);
        $logo_dlh = Logo::find(3);
        $logo_alur = Logo::find(4);

        return view('home.index',  compact('laporan','status','category', 'komentar', 'logo_utama', 'logo_kedua', 'logo_dlh', 'logo_alur','pelayanan'));
    }

}
