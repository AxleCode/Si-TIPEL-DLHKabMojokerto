<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Laporan;
use Illuminate\View\View;
use App\Models\Notifikasi;
use App\Models\CategoryAduan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCategoryAduanRequest;
use App\Http\Requests\UpdateCategoryAduanRequest;

class CategoryAduanController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $category = CategoryAduan::withCount('laporan')->get();
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                    ->where('status', true)
                    ->count();
        
        return view('dashboard.kategori.index', compact('category', 'notifikasi', 'jumlahnotif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreCategoryAduanRequest $request): RedirectResponse
    {
         // Start a new transaction
        DB::beginTransaction();
        try {
            $validateData = $request->validate([
                'name' => 'required|max:255|unique:category_aduans,name',
                'deskripsi' => 'required|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1048',
            ]);

            // Handle image upload and storage
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = public_path('img');
                $image->move($imagePath, $imageName);
                $imagePath = 'img/' . $imageName; // store relative path to database
            }

            $categoryAduan = new CategoryAduan;
            $categoryAduan->name = $validateData['name'];
            $categoryAduan->deskripsi = $validateData['deskripsi'];
            $categoryAduan->image = $imagePath;
            $categoryAduan->save();
            
            DB::commit();   

            toast('Kategori telah ditambahkan', 'success')->autoClose(5000)->width('320px');
            return redirect('dashboard/kategori');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage();
            toast($errorMessage, 'error')->autoClose(5000)->width('350px');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryAduan $categoryAduan, $id): View
    {
        // Find the category by its ID
        $category = CategoryAduan::findOrFail($id);
        
        $laporans = Laporan::select('laporans.*', 'statuses.name', 'statuses.warna')
                    ->join('statuses', 'statuses.kode_status', '=', 'laporans.status')
                    ->where('laporans.category_aduan_id', $id)
                    ->orderBy('laporans.created_at', 'desc')
                    ->paginate(30);
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                                ->orderByDesc('created_at')
                                ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                                ->where('status', true)
                                ->count();
        
        return view('dashboard.kategori.show', compact('category', 'laporans', 'notifikasi', 'jumlahnotif'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryAduan $categoryAduan, $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryAduanRequest $request, CategoryAduan $categoryAduan, $id)
    {
        // Start a new transaction
        DB::beginTransaction();

        try {
            $category = CategoryAduan::findOrFail($id);
            
            // Handle image upload and storage
            $imagePath = $category->image;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = public_path('img');
                $image->move($imagePath, $imageName);
                $imagePath = 'img/' . $imageName; // store relative path to database
                
                // Delete old image
                if (File::exists(public_path($category->image))) {
                    File::delete(public_path($category->image));
                }
            }
            
            $category->update([
                'name' => $request->name,
                'deskripsi' => $request->deskripsi,
                'image' => $imagePath,
            ]);

            DB::commit();   

            toast('Kategori berhasil diperbarui', 'success')->autoClose(5000)->width('320px');
    
            return redirect()->route('kategori.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage();
            toast($errorMessage, 'error')->autoClose(5000)->width('320px');
            return redirect()->route('kategori.index');
        }
    }
    
    
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAduan $categoryAduan, $id)
    {
        $category = CategoryAduan::withCount('laporan')->findOrFail($id);

        // Check if laporan_count is null
        if ($category->laporan_count !== 0) {
            toast('Tidak dapat menghapus kategori yang memiliki laporan','error')->autoClose(5000)->width('420px');
            return redirect('/dashboard/kategori');
        }


        $category->delete();
        
        toast('Kategori telah dihapus','success')->autoClose(5000)->width('320px');
        return redirect('/dashboard/kategori');
    }
}
