<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->paginate(15);;
        $jumlahnotif = Notifikasi::where('user_id', $user->id)
                    ->where('status', true)
                    ->count();
        return view('dashboard.profile.index', compact('notifikasi', 'jumlahnotif'));
    }

    public function update(User $user, Request $request)
    {   

        if ($request->input('submit_type') == 'profile') {
            $request->validate([
                'enable_disable' => 'nullable|boolean',
                'email' => $request->input('enable_disable') ? 'required|email:dns|unique:users' : 'nullable|email:dns|unique:users,email,' . $user->id,    
                'name' => 'required|max:100',
                'alamatpemohon' => 'required|max:255',
                'nohp' => 'required|max:20'
            ]);
            $user =Auth::user();
            if ($request->input('enable_disable')) {
                $user->email = $request['email'];
            }
            $user->name = $request['name'];
            $user->alamatpemohon = $request['alamatpemohon'];
            $user->nohp = $request['nohp'];
            $user->save();

            toast('Profile user berhasil diubah','success')->autoClose(5000)->width('320px');
            return redirect('/dashboard/profile');
        } 
        
        elseif ($request->input('submit_type') == 'password') {
           # Validation
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|min:8|max:255|confirmed',
            ]);


            #Match The Old Password
            if(!Hash::check($request->current_password, auth()->user()->password)){
                return redirect('/dashboard/profile')->with("error", "Password lama salah!");
            }


            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
            toast('Password user berhasil diubah','success')->autoClose(5000)->width('320px');
            return redirect('/dashboard/profile');
        } 

        else {
            // Handle "Submit" button submission
        }

       
    }


}
