<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Laporan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::withCount(['laporan as laporan_count'])->get();
        $colors = [
            'danger' => 'Merah',
            'success' => 'Hijau',
            'primary' => 'Biru',
            'warning' => 'Kuning',
        ];
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                    ->where('status', true)
                    ->count();
                    
        return view('dashboard.status.index', compact('statuses', 'colors','notifikasi', 'jumlahnotif'));
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
        try {
            $validateData = $request->validate([
                'kode' => 'required|unique:statuses,kode_status',
                'name' => 'required|max:255|unique:statuses,name',
                'color' => 'required',
                'deskripsi' => 'required',
            ]);

            $status = new Status();
            $status->name = $validateData['name'];
            $status->kode_status = $validateData['kode'];
            $status->warna = $validateData['color'];
            $status->deskripsi = $validateData['deskripsi'];
            $status->save();

            toast('Status telah ditambahkan', 'success')->autoClose(5000)->width('320px');
            return redirect()->back();
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            toast($errorMessage, 'error')->autoClose(5000)->width('320px');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($kode_status)
    {
        // Find the status by its kode_status
        $status = Status::where('kode_status', $kode_status)->firstOrFail();
    
        $laporans = Laporan::select('laporans.*', 'category_aduans.name')
            ->join('category_aduans', 'category_aduans.id', '=', 'laporans.category_aduan_id')
            ->where('laporans.status', $kode_status)
            ->orderBy('laporans.created_at', 'desc')
            ->paginate(30);
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                        ->orderByDesc('created_at')
                        ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                        ->where('status', true)
                        ->count();
    
        return view('dashboard.status.show', compact('status', 'laporans', 'notifikasi', 'jumlahnotif'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required|max:255|unique:statuses,name,'.$status->id,
                'color' => 'required',
                'deskripsi' => 'required',
            ]);
    
            $status->name = $validateData['name'];
            $status->warna = $validateData['color'];
            $status->deskripsi = $validateData['deskripsi'];
            $status->save();
    
            toast('Status telah diperbarui', 'success')->autoClose(5000)->width('320px');
            return redirect()->back();
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            toast($errorMessage, 'error')->autoClose(5000)->width('320px');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        $statuses = Status::withCount('laporan')->findOrFail($status->id);

        // Check if laporan_count is null
        if ($statuses->laporan_count !== 0) {
            toast('Tidak dapat menghapus status yang memiliki laporan','error')->autoClose(5000)->width('420px');
            return redirect('/dashboard/status');
        }

        $statuses->delete();
        
        toast('Status telah dihapus','success')->autoClose(5000)->width('320px');
        return redirect('/dashboard/status');
    }
}
