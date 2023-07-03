<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Notifikasi;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreLogoRequest;
use App\Http\Requests\UpdateLogoRequest;
use App\Models\Pelayanan;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $pelayanan = Pelayanan::orderBy('nomor', 'asc')->get();
        $nomor_pelayanan = Pelayanan::pluck('nomor')->toArray();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                    ->where('status', true)
                    ->count();
        $logos1 = Logo::all()->slice(0, 2);
        $logos2 = Logo::all()->slice(2, 4);

        return view('dashboard.website.index', compact('notifikasi', 'jumlahnotif','logos1','logos2', 'pelayanan','nomor_pelayanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function buatPelayanan(Request $request)
    {
        $validateData = $request->validate([
            'nomor' => 'required',
            'slug' => 'required|max:100',
            'body' => 'required|max:255',
        ]);
    
        DB::beginTransaction();
    
        try {
            $pelayanan = new Pelayanan();
            $pelayanan->nomor = $validateData['nomor'];
            $pelayanan->slug = $validateData['slug'];
            $pelayanan->body = $validateData['body'];
            $pelayanan->save();
    
            DB::commit();
    
            toast('Alur layanan berhasil ditambahkan', 'success')->autoClose(5000)->width('320px');
    
            return redirect()->route('website.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage();
            toast($errorMessage, 'error')->autoClose(5000)->width('320px');
            return redirect()->route('website.index');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Logo $logo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logo $logo)
    {
        
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLogoRequest $request, Logo $logo, $id)
    {

    }

    public function updateLogo1(UpdateLogoRequest $request, Logo $logo, $id)
    {
           // Start a new transaction
        DB::beginTransaction();

        try {
            $logo = Logo::findOrFail($id);

            // Handle image upload and storage
            $imagePath = $logo->image_path;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = public_path('logo');
                $image->move($imagePath, $imageName);
                $imagePath = 'logo/' . $imageName; // store relative path to database

                // Delete old image
                if (File::exists(public_path($logo->image_path))) {
                    File::delete(public_path($logo->image_path));
                }
            }

            $logo->update([
                'image_path' => $imagePath,
            ]);

            DB::commit();

            toast('Logo berhasil diperbarui', 'success')->autoClose(5000)->width('320px');

            return redirect()->route('website.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage();
            toast($errorMessage, 'error')->autoClose(5000)->width('320px');
            return redirect()->route('website.index');
        }
    }

    public function updatePelayanan(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'nomor' => 'required',
            'slug' => 'required',
            'body' => 'required',
        ]);

        try {
            // Find the pelayanan by ID
            $pelayanan = Pelayanan::findOrFail($id);

            // Update the pelayanan with the validated data
            $pelayanan->nomor = $request->input('nomor');
            $pelayanan->slug = $request->input('slug');
            $pelayanan->body = $request->input('body');
            $pelayanan->save();

            // Redirect back or to a specific route after successful update
            return redirect()->back()->with('success', 'Pelayanan has been updated successfully');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            toast($errorMessage, 'error')->autoClose(5000)->width('420px');
            return redirect()->route('website.index');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            // Find the pelayanan by ID
            $pelayanan = Pelayanan::findOrFail($id);
    
            // Delete the pelayanan
            $pelayanan->delete();
    
            // Redirect back or to a specific route after successful deletion
            return redirect()->back()->with('success', 'Pelayanan has been deleted successfully');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            toast($errorMessage, 'error')->autoClose(5000)->width('420px');
            return redirect()->route('website.index');
        }
    }
    
}
