<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Status;
use App\Models\Laporan;
use App\Models\Komentar;
use Illuminate\View\View;
use App\Models\Notifikasi;
use App\Models\LaporanImage;
use App\Models\CategoryAduan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PetugasController extends Controller
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

        return view('dashboard.petugas.index', compact('category','laporan','statuses', 'notifikasi', 'jumlahnotif'));
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
            $notification->pesan = 'Status Laporan anda dengan ID '.$laporan->id.' telah diupdate oleh petugas';
            $notification->status = true;
            $notification->logo = 'clipboard'; 
            $notification->textlogo = 'text-primary'; 
            $notification->link = '/dashboard/laporan/'.$laporan->id;
            $notification->save();
            
            if ($laporan->status == 1) {
                $surveyorRoles = ['surveyor']; // Daftar role yang dianggap sebagai surveyor atau surveyor

                $petugasUsers = User::where(function ($query) use ($surveyorRoles) {
                    foreach ($surveyorRoles as $role) {
                        $query->orWhere('role', $role);
                    }
                })->get();

                foreach ($petugasUsers as $petugasUser) {
                    $petugasNotification = new Notifikasi();
                    $petugasNotification->user_id = $petugasUser->id;
                    $petugasNotification->judul = 'Laporan Update';
                    $petugasNotification->pesan = 'Laporan dengan Nomor tiket '.$laporan->nomor_tiket.' telah diupdate';
                    $petugasNotification->status = true;
                    $petugasNotification->logo = 'clipboard'; 
                    $petugasNotification->textlogo = 'text-warning'; 
                    $petugasNotification->link = '/dashboard/petugas/'.$laporan->id.'/edit';
                    $petugasNotification->save();
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laporan = Laporan::find($id);
        $user = User::find($laporan->user_id);
        $userName = $user->name;
        $statuses = Status::all();
        $images = LaporanImage::where('laporan_id', $laporan->id)->get();
        $komentar = Komentar::with('status')->where('laporan_id', $laporan->id)->orderBy('updated_at', 'desc')->get();
        
        $notifikasi = Notifikasi::where('user_id', 4)
        ->orderByDesc('created_at')
        ->paginate(15);
    
        $jumlahnotif = Notifikasi::where('user_id', 4)
            ->where('status', true)
            ->count();
        
        if(auth()->user()->role === 'admin' || auth()->user()->role === 'petugas') {
            return view('dashboard.petugas.edit', compact('laporan','userName','statuses','images','komentar', 'notifikasi', 'jumlahnotif'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
