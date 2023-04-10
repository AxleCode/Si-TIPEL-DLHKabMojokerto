<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('registrasi', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255',
            'alamatpemohon' => 'required|max:255',
            'nohp' => 'required|max:20'
        ]);
        // $validateData['password'] = bcrypt($validateData['password']);
        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        // session()->flash('success', "Registration successfull! Please login!");

        return redirect('/login')->with('success', "Registration successfull! Please login!");
    
    }
}
