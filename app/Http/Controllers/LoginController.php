<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $logo_utama = Logo::find(1);
        $logo_kedua = Logo::find(2);
        $logo_dlh = Logo::find(3);
        
        return view('login', [
            'title' => 'Login',
            'active' => 'login',
            'logo_kedua' => $logo_kedua,
            'logo_dlh' => $logo_dlh,
        ]);
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // if ( Auth::attempt()->user()->email_verified_at === NULL){
        //     return back()->with('loginError', 'Login failed please verify email first!');
        // }
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        
        else{
            return back()->with('loginError', 'Login failed');
        }
       
    }

    public function logout()
    {
        Auth::logout();
 
        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect('/');
    }
}
