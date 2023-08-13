<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $logo_kedua = Logo::find(2);
        $logo_dlh = Logo::find(3);
        return view('registrasi', [
            'title' => 'Register',
            'active' => 'register',
            'logo_kedua' => $logo_kedua,
            'logo_dlh' => $logo_dlh,
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255',
            'alamatpemohon' => 'required|max:255',
            'nohp' => 'required|max:20',
            'role' => 'required',
            'active' => 'required',
        ]);
        // $validateData['password'] = bcrypt($validateData['password']);
        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        // session()->flash('success', "Registration successfull! Please login!");

        return redirect('/login')->with('success', "Registration successfull! Please login!");
    }
}
