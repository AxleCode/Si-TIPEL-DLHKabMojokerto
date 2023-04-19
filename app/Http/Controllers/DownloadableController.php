<?php

namespace App\Http\Controllers;

use App\Models\Downloadable;
use App\Http\Requests\StoreDownloadableRequest;
use App\Http\Requests\UpdateDownloadableRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class DownloadableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $downloadable = Downloadable::paginate(20);
        return view('dashboard.downloadable.indexadmin', compact('downloadable'));
    }

    public function user()
    {
        $downloadable = Downloadable::paginate(20);
        return view('dashboard.downloadable.index', compact('downloadable'));

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
    public function store(StoreDownloadableRequest $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required|max:255',
                'file' => 'required|mimes:jpeg,png,jpg,gif,pdf,rar|max:10048',
                'deskripsi' => 'required|max:500',
            ]);

            // Save the file to storage
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = public_path('/downloadable/');
                $file->move($filePath, $filename);

                $fileSizeInBytes = filesize($filePath . $filename);
                $fileSize = round($fileSizeInBytes / 1048576, 2); // in megabytes, rounded to 2 decimal places
            
            } else {
                $filename = '';
            }

            $download = new Downloadable();
            $download->name = $validateData['name'];
            $download->file = $filename;
            $download->ukuran = $fileSize. ' MB';
            $download->deskripsi = $validateData['deskripsi'];
            $download->save();

            toast('File Downloadable telah ditambahkan', 'success')->autoClose(5000)->width('320px');
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
    public function show(Downloadable $downloadable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Downloadable $downloadable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDownloadableRequest $request, Downloadable $downloadable, $id)
    {
        $download = Downloadable::find($id);

        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'file' => 'required|mimes:jpeg,png,jpg,gif,pdf,rar|max:10048',
            'deskripsi' => 'required|max:500',
        ]);

        // Retrieve the old filename
        $oldFilename = $download->file;

        // Update the record in the database
        $download->name = $validatedData['name'];
        $download->deskripsi = $validatedData['deskripsi'];
    
        // Save the file to storage
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = public_path('/downloadable/');
            $file->move($filePath, $filename);

            $fileSizeInBytes = filesize($filePath . $filename);
            $fileSize = round($fileSizeInBytes / 1048576, 2); // in megabytes, rounded to 2 decimal places
            
            // Delete the old file
            if ($oldFilename) {
                $oldFilePath = public_path('/downloadable/') . $oldFilename;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        } else {
            $filename = $oldFilename;
            $fileSize = $download->ukuran;
        }

        $download->file = $filename;
        $download->ukuran = $fileSize. ' MB';
        $download->save();
    
        // Redirect to the previous page with a success message
        toast('Data Berhasil Diubah', 'success')->autoClose(5000)->width('320px');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Downloadable $downloadable, $id)
    {
        try {
            $download = Downloadable::find($id);
            $filePath = public_path('/downloadable/' . $download->file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
    
            $download->delete();
    
            toast('File Downloadable telah dihapus', 'success')->autoClose(5000)->width('320px');
            return redirect()->back();
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            toast($errorMessage, 'error')->autoClose(5000)->width('320px');
            return redirect()->back()->withInput();
        }
    }
}
