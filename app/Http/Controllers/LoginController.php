<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' =>'login',
        ]);
    }

    public function verifikasi(Request $request){
        $user = User::where('email',$request->email)->first();
        if(empty($user)){
            return back()->with('loginError','Login failed!'); 
        }
        if($user->is_active != 1){
            return back()->with('loginError','Login failed! Account hasn\'t been activated'); 
        }
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if(Auth::user()->role_id == 1){
                return redirect('/dashboard');
            } else if(Auth::user()->role_id == 2){
                return redirect('/admin/dashboard');
            }
        }
        return back()->with('loginError','Login failed!'); 
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success','Logout Berhasil!');
    }
}