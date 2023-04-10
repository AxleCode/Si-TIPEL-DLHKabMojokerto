<?php
   
namespace App\Http\Controllers;
   
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
  
class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(User $user, Request $request)
    {   
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

        return redirect('/dashboard/profile')->with('successpass', "Password updated successfully!");
    }

    
}