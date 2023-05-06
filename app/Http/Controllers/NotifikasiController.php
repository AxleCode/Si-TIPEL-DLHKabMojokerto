<?php

namespace App\Http\Controllers;

use App\Models\User;
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
                                ->paginate(10);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
            ->where('status', true)
            ->count();
        return view('dashboard/notifikasi/index', compact('notifikasi', 'jumlahnotif'));
    }

    public function update($id, Request $request)
    {
        try {
            $notification = Notifikasi::findOrFail($id);
            $notification->status = false;
            $notification->save();
            return redirect($notification->link);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            toast($errorMessage, 'error')->autoClose(5000)->width('320px');
            return redirect()->back()->withInput();
        }
    }

    public function updateall(Request $request)
    {
        try {
            $user = Auth::user();
            $user->notifikasi()->update(['status' => false]);
            return redirect()->back();
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            toast($errorMessage, 'error')->autoClose(5000)->width('320px');
            return redirect()->back()->withInput();
        }
    }
}
