<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::where('status', 1)->orderBy('updated_at', 'desc')->paginate(5);
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                    ->where('status', true)
                    ->count();

        if ( auth()->user()->email_verified_at === NULL){
                return back()->with('loginError', 'Login failed please verify email first!');
            }
        return view('dashboard.index', compact('pengumumans', 'notifikasi', 'jumlahnotif'));
    }

   
}
