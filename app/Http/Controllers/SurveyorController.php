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
use Illuminate\Support\Facades\File;

class SurveyorController extends Controller
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

        return view('dashboard.surveyor.index', compact('category','laporan','statuses', 'notifikasi', 'jumlahnotif'));
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
            'webcam_photo' => 'required', // Ganti 'file' menjadi 'webcam_photo'
            'komentar' => 'required',
            'koordinat_surveyor' => 'required',
            'alamat_surveyor' => 'required',
            'laporan_id' => 'required',
        ]);
        // dd($request);
        // Start a new transaction
        DB::beginTransaction();

        try {
            $laporan = Laporan::find($request->laporan_id);

            if (!$laporan) {
                return redirect()->back()->with('error', 'Laporan tidak ditemukan.');
            }
            
        // Save the webcam photo to storage
        if ($request->has('webcam_photo')) {
            $webcamPhotoData = $request->input('webcam_photo');
            $webcamPhotoPath = public_path('/komentar_file/');
            $webcamPhotoName = time() . '_webcam_photo.jpg'; // Ubah nama sesuai kebutuhan
            $this->saveBase64Image($webcamPhotoData, $webcamPhotoPath, $webcamPhotoName);
        } else {
            $webcamPhotoName = '';
        }
            // Create a new Komentar instance
            $komentar = new Komentar;
            $komentar->laporan_id = $request->laporan_id;
            $komentar->file = $webcamPhotoName; 
            $komentar->komentar = $request->komentar;
            $komentar->alamat_petugas = $request->alamat_surveyor;
            $komentar->koordinat_petugas = $request->koordinat_surveyor;
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

    // Method to save base64 image to file
    private function saveBase64Image($base64Data, $filePath, $fileName)
    {
        if (!File::exists($filePath)) {
            File::makeDirectory($filePath, 0777, true);
        }

        $data = explode(',', $base64Data);
        $imageData = base64_decode($data[1]);

        $imagePath = $filePath . $fileName;
        File::put($imagePath, $imageData);
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
        
        $notifikasi = Notifikasi::where('user_id', 5)
                    ->orderByDesc('created_at')
                    ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', 5)
                    ->where('status', true)
                    ->count();
        
        if(auth()->user()->role === 'admin' || auth()->user()->role === 'surveyor') {
            return view('dashboard.surveyor.edit', compact('laporan','userName','statuses','images','komentar', 'notifikasi', 'jumlahnotif'));
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
