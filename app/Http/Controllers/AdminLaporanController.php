<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use App\Models\Laporan;
use App\Models\Komentar;
use Illuminate\View\View;
use App\Models\Notifikasi;
use App\Models\LaporanImage;
use Illuminate\Http\Request;
use App\Models\CategoryAduan;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminLaporanController extends Controller
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


        return view('dashboard.laporanadmin.index', compact('category','laporan','statuses', 'notifikasi', 'jumlahnotif'));
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
        $request->validate([
            'status' => 'required',
            'file' => 'nullable|mimes:jpeg,jpg,png,pdf|max:1024',
            'komentar' => 'required',
            'laporan_id' => 'required',
        ]);
    
        $laporan = Laporan::find($request->laporan_id);
    
        if (!$laporan) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan.');
        }
        
        // Save the file to storage
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = public_path('/komentar_file/');
            $file->move($filePath, $filename);
        } else {
            $filename = '';
        }
        
        // Create a new Komentar instance
        $komentar = new Komentar;
        $komentar->laporan_id = $request->laporan_id;
        $komentar->file = $filename;
        $komentar->komentar = $request->komentar;
        $komentar->status = $request->status;
        $komentar->updated_at = Carbon::now('Asia/Jakarta');
        $komentar->save();
    
        // Update the status of the Laporan instance
        $laporan->status = $request->status;
        $laporan->save();
    
        toast('Laporan berhasil diupdate','success')->autoClose(5000)->width('320px');
        return redirect()->back();
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan, $id)
    {
        $laporan = Laporan::find($id);
        $user = User::find($laporan->user_id);
        $userName = $user->name;
        $statuses = Status::all();
        $images = LaporanImage::where('laporan_id', $laporan->id)->get();
        $komentar = Komentar::with('status')->where('laporan_id', $laporan->id)->orderBy('updated_at', 'desc')->get();
        
        if(auth()->user()->is_admin || auth()->user()->id == $laporan->user_id) {
            return view('dashboard.laporanadmin.edit', compact('laporan','userName','statuses','images','komentar'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan, $id)
    {
        $request->validate([
            'status' => 'required',
            'komentar' => 'required',
            'file' => 'nullable|mimes:jpeg,jpg,png,pdf|max:1048'
        ]);
    
        $laporan = Laporan::find($id);
        $laporan->status = $request->status;
    
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('komentar_file/' . $filename);
            Image::make($image->getRealPath())->resize(600, 400)->save($path);
            $laporan->image = $filename;
        }
    
        $laporan->save();
    
        $komentar = new Komentar;
        $komentar->laporan_id = $laporan->id;
        $komentar->user_id = auth()->user()->id;
        $komentar->komentar = $request->komentar;
    
        $komentar->save();
    
        return back()->with('success', 'Laporan Aduan berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan, $id)
    {
        $laporan = Laporan::findOrFail($id);
        // Delete the laporan images from the disk
        foreach ($laporan->laporanImages as $image) {
            unlink(public_path($image->image_path));
        }        
         
        // Delete the laporan record from the database
        $laporan->delete();

        // Delete the laporan images from the database
        $laporan->laporanImages()->delete();
         
        return redirect()->back()->with('success', 'Laporan berhasil dihapus');
    }
}
