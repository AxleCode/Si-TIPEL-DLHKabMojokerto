<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Notifikasi;
use App\Models\Pengumuman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminPengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumumans = Pengumuman::orderBy('updated_at', 'desc')->paginate(10);
        // foreach ($pengumumans as $pengumuman) {
        //     $pengumuman->judul = Str::limit($pengumuman->judul, 50);
        // }
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->paginate(15);
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                    ->where('status', true)
                    ->count();

        return view('dashboard.pengumuman.index', compact('pengumumans', 'notifikasi', 'jumlahnotif'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'judul' => 'required|max:255',
                'body' => 'required',
                'status' => 'required'
            ]);
    
            Pengumuman::create($validateData);
    
            toast('Pengumuman telah ditambahkan', 'success')->autoClose(5000)->width('320px');
    
            return redirect('dashboard/pengumuman');
        } catch (\Exception $e) {
            // Handle the exception here
            // You can log the error, display a custom error message, or perform any necessary actions
            // For example:
            toast('Terjadi kesalahan saat menyimpan pengumuman: '.$e->getMessage(), 'error')->autoClose(5000)->width('420px');
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan pengumuman: '.$e->getMessage()]);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                                ->orderByDesc('created_at')
                                ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                                ->where('status', true)
                                ->count();
        return view('dashboard.pengumuman.show', compact('pengumuman', 'notifikasi', 'jumlahnotif'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumuman $pengumuman)
    {
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                    ->where('status', true)
                    ->count();
        return view('dashboard.pengumuman.edit', compact('pengumuman', 'notifikasi', 'jumlahnotif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $rules = [
            'judul' => 'required|max:255',
            'body' => 'required',
            'status' => 'required'
        ];
        $validateData = $request->validate($rules);
    
        $validateData['body'] = $request->input('body');
    
        $pengumuman->update($validateData);
    
        toast('Pengumuman telah diupdate', 'success')->autoClose(5000)->width('320px');
    
        return redirect('dashboard/pengumuman');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Pengumuman $pengumuman)
    {
        Pengumuman::destroy($pengumuman->id);
        toast('Pengumuman telah dihapus','success')->autoClose(5000)->width('320px');
        return redirect('/dashboard/pengumuman');
    }
}
