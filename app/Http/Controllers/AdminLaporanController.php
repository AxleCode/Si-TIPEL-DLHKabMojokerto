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
use Illuminate\Support\Facades\DB;
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
        
        // Start a new transaction
        DB::beginTransaction();

        try {
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
            $komentar->petugas = Auth::user()->name;
            $komentar->transportasi = $request->transportasi;
            $komentar->updated_at = Carbon::now('Asia/Jakarta');
            $komentar->save();
        
            // Update the status of the Laporan instance
            $laporan->status = $request->status;
            $laporan->save();

            // Create a new notification
            $notification = new Notifikasi();
            $notification->user_id = $laporan->user_id;
            $notification->judul = 'Laporan Update';
            $notification->pesan = 'Status Laporan anda dengan ID '.$laporan->nomor_tiket.' telah diupdate oleh petugas';
            $notification->status = true;
            $notification->logo = 'clipboard'; 
            $notification->textlogo = 'text-primary'; 
            $notification->link = '/dashboard/laporan/'.$laporan->id;
            $notification->save();
            
            if ($laporan->status == 1) {
                $surveyorRoles = ['surveyor']; // Daftar role yang dianggap sebagai surveyor atau surveyor

                $surveyorUsers = User::where(function ($query) use ($surveyorRoles) {
                    foreach ($surveyorRoles as $role) {
                        $query->orWhere('role', $role);
                    }
                })->get();

                foreach ($surveyorUsers as $surveyorUser) {
                    $surveyorNotification = new Notifikasi();
                    $surveyorNotification->user_id = $surveyorUser->id;
                    $surveyorNotification->judul = 'Laporan Baru Diupdate';
                    $surveyorNotification->pesan = 'Laporan dengan Nomor tiket '.$laporan->nomor_tiket.' telah Diterima mohon tindak lanjutnya';
                    $surveyorNotification->status = true;
                    $surveyorNotification->logo = 'clipboard'; 
                    $surveyorNotification->textlogo = 'text-warning'; 
                    $surveyorNotification->link = '/dashboard/surveyor/'.$laporan->id.'/edit';
                    $surveyorNotification->save();
                }
            }
            // Commit the transaction
            DB::commit();

        
        toast('Laporan berhasil diupdate','success')->autoClose(5000)->width('320px');
        return redirect()->back();
    } catch (\Exception $e) {
        // An error occurred, rollback the transaction
        DB::rollBack();
        return redirect()->back()->with('error', 'Error submitting laporan: ' . $e->getMessage());
    }
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
        
        $notifikasi = Notifikasi::where('user_id', 1)
        ->orderByDesc('created_at')
        ->paginate(15);
    
        $jumlahnotif = Notifikasi::where('user_id', 1)
            ->where('status', true)
            ->count();
        
        if(auth()->user()->role === 'admin' || auth()->user()->id == $laporan->user_id || auth()->user()->role === 'surveyor' || auth()->user()->role === 'petugas') {
            return view('dashboard.laporanadmin.edit', compact('laporan','userName','statuses','images','komentar', 'notifikasi', 'jumlahnotif'));
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

         // Start a new transaction
         DB::beginTransaction();

            try {
        
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
                // Commit the transaction
                DB::commit();
            return back()->with('success', 'Laporan Aduan berhasil diperbaharui');
    } catch (\Exception $e) {
        // An error occurred, rollback the transaction
        DB::rollBack();
        return redirect()->back()->with('error', 'Update laporan Error: ' . $e->getMessage());
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan, $id)
    {
        // Start a new transaction
        DB::beginTransaction();

        try {

            $laporan = Laporan::findOrFail($id);
            // Delete the laporan images from the disk
            foreach ($laporan->laporanImages as $image) {
                unlink(public_path($image->image_path));
            }        
            
            // Delete the laporan record from the database
            $laporan->delete();

            // Delete the laporan images from the database
            $laporan->laporanImages()->delete();
            // Commit the transaction
            DB::commit();           
            return redirect()->back()->with('success', 'Laporan berhasil dihapus');
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();
            return redirect()->back()->with('error', 'Hapus laporan Error: ' . $e->getMessage());
        }
    }
    
}
