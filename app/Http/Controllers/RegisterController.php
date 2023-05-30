<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
        ]);
    }

    public function verify(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => ['required','email:dns', 'unique:users'],
            'password' => ['required','min:4','max:255'],
            'no_hp' => ['required','min:11','max:13'],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['is_active'] = 1;
        $validatedData['photo'] = 'profile/default.jpg';
        $validatedData['role_id'] = 1;
        User::create($validatedData);
        return redirect('/login')->with('success', 'Registration Successful!! Please Active your account');
    }
}