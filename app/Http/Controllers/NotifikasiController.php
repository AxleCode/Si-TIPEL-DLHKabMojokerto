<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                                ->orderByDesc('created_at')
                                ->paginate(30);;
        return view('dashboard/notifikasi/index', compact('notifikasi'));
    }
}
