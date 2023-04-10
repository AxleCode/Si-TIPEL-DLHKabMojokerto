<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::where('status', 1)->orderBy('updated_at', 'desc')->paginate(5);

        if ( auth()->user()->email_verified_at === NULL){
                return back()->with('loginError', 'Login failed please verify email first!');
            }
        return view('dashboard.index', compact('pengumumans'));
    }

   
}
