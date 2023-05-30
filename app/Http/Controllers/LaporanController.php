<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Laporan;
use App\Models\Komentar;
use Illuminate\View\View;
use App\Models\Notifikasi;
use App\Models\LaporanImage;
use Illuminate\Http\Request;
use App\Models\CategoryAduan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreLaporanRequest;
use App\Http\Requests\UpdateLaporanRequest;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $category = CategoryAduan::all();
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                    ->where('status', true)
                    ->count();
        $laporan = Laporan::where('user_id', $user->id)
                  ->orderByDesc('created_at')
                  ->paginate(6);;
        $statuses = Status::all();
        $laporanImages = LaporanImage::whereIn('laporan_id', $laporan->pluck('id'))->get();

        return view('dashboard.laporan.index', compact('category','laporan','statuses','laporanImages','notifikasi', 'jumlahnotif'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $category = CategoryAduan::all();
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                    ->where('status', true)
                    ->count();

        return view('dashboard.laporan.create', compact('category','notifikasi', 'jumlahnotif','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLaporanRequest $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'nama' => 'required|max:255',
            'telpon' => 'required|max:50',
            'email' => 'required|max:125',
            'category' => 'required|exists:category_aduans,id',
            'body' => 'required',
            'coordinates' => 'required',
            'address' => 'required',
            'imageFile.*' => 'image|max:5000|required', // Max size of each image is 5 MB
        ]);

        // Start a new transaction
        DB::beginTransaction();

        try {
            // Buat Laporan baru
            $laporan = new Laporan();
            $laporan->judul = $validatedData['judul'];
            $laporan->nama = $validatedData['nama'];
            $laporan->telpon = $validatedData['telpon'];
            $laporan->email = $validatedData['email'];
            $laporan->body = $validatedData['body'];
            $laporan->category_aduan_id = $validatedData['category'];
            $laporan->user_id = auth()->id(); 
            $laporan->status = 0; 
            $laporan->coordinates = $request->input('coordinates');
            $laporan->address = $request->input('address');

            $laporan->save();
        
            // Upload file gambar ke db laporan_images dan menggunakan foreign key laporan
            if ($request->hasFile('imageFile')) {
                foreach ($request->file('imageFile') as $file) {
                    $fileName = $file->getClientOriginalName();
                    $filePath = public_path('/laporan_images/');
                    $file->move($filePath, $fileName);
            
                    // Save the image path to the database
                    $image = new LaporanImage();
                    $image->laporan_id = $laporan->id;
                    $image->image_path = 'laporan_images/'.$fileName;
                    $image->save();
                }
            }

            // Create a new notification for client
            $notification = new Notifikasi();
            $notification->user_id = auth()->id();
            $notification->judul = 'Laporan Baru Dibuat';
            $notification->pesan = 'Laporan anda dengan ID '.$laporan->id.' telah dibuat dan sedang dalam antrian.';
            $notification->status = true;
            $notification->logo = 'clipboard'; 
            $notification->textlogo = 'text-primary'; 
            $notification->link = '/dashboard/laporan/'.$laporan->id;
            $notification->save();

            // Create a new notification for admin
            $notification = new Notifikasi();
            $notification->user_id = 1;
            $notification->judul = 'Laporan Baru Dibuat';
            $notification->pesan = 'Laporan dengan ID '.$laporan->id.' telah dibuat Mohon tindak lanjutnya';
            $notification->status = true;
            $notification->logo = 'clipboard'; 
            $notification->textlogo = 'text-warning'; 
            $notification->link = '/dashboard/laporanadmin/'.$laporan->id.'/edit';
            $notification->save();
            // Commit the transaction
            DB::commit();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil disubmit!');
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();
            return redirect()->back()->with('error', 'Error submitting laporan: ' . $e->getMessage());
        }
            
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan): View
    {
        $laporan->load('user','categoryAduan');
        $statuses = Status::all();
        $images = LaporanImage::where('laporan_id', $laporan->id)->get();
        $komentar = Komentar::with('status')->where('laporan_id', $laporan->id)->orderBy('updated_at', 'desc')->get();
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                    ->where('status', true)
                    ->count();

        return view('dashboard.laporan.show', compact('laporan','statuses','images','komentar','notifikasi', 'jumlahnotif'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaporanRequest $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan, Request $request)
    {
         // Delete the laporan record from the database
        $laporan->delete();

        // Delete the laporan images from the disk
        foreach ($laporan->laporanImages as $image) {
            unlink(public_path($image->image_path));
        }        

        // Delete the laporan images from the database
        $laporan->laporanImages()->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus');
    }
}
