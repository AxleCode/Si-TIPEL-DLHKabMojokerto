<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Models\CategoryAduan;
use App\Models\Komentar;
use App\Models\Status;

class MapController extends Controller
{
    public function index()
    {
        $laporan = Laporan::with('status')->get();
        $status = Status::all();
        $komentar = Komentar::all();
        $category = CategoryAduan::all();

        return view('dashboard/map',  compact('laporan','status','category', 'komentar'));
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
