<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreKomentarRequest;
use App\Http\Requests\UpdateKomentarRequest;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreKomentarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Komentar $komentar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Komentar $komentar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKomentarRequest $request, $id)
    {
        // Start a new transaction
        DB::beginTransaction();

        try {
            $komentar = Komentar::find($id);

            // Validate the input data
            $validatedData = $request->validate([
                'status' => 'required',
                'komentar' => 'required',
                'file' => 'mimes:jpeg,jpg,png,pdf|max:1048'
            ]);

            // Retrieve the old filename
            $oldFilename = $komentar->file;

            // Update the record in the database
            $komentar->status = $validatedData['status'];
            $komentar->komentar = $validatedData['komentar'];
        
            // Save the file to storage
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = public_path('/komentar_file/');
                $file->move($filePath, $filename);
                
                // Delete the old file
                if ($oldFilename) {
                    $oldFilePath = public_path('/komentar_file/') . $oldFilename;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
            } else {
                $filename = $oldFilename;
            }

            $komentar->file = $filename;
            $komentar->save();
            DB::commit();   
            // Redirect to the previous page with a success message
            toast('Komentar Berhasil Diubah', 'success')->autoClose(5000)->width('320px');
            return redirect()->back();
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();
            return redirect()->back()->with('error', 'Update Komentar Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Start a new transaction
        DB::beginTransaction();

        try {
            $komentar = Komentar::find($id);
            $filePath = public_path('/komentar_file/' . $komentar->file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
    
            $komentar->delete();
            DB::commit();   
            toast('Komentar telah dihapus', 'success')->autoClose(5000)->width('320px');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage();
            toast('Gagal hapus komentar', 'error')->autoClose(5000)->width('320px');
            return redirect()->back()->withInput();
        }
    }
}
