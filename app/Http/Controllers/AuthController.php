<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }
 
    public function registerPost(Request $request)
    {
        try {
            // Create and save the user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
    
            return redirect()->route('login')->with('success', 'Registered successfully. Please log in.');
        } catch (\Exception $e) {
            return redirect()->route('register')->with('error', 'This email is already registered.');
        }
    }
 
    public function login()
    {
        return view('login');
    }
 
    public function loginPost(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        if (Auth::attempt($credentials)) {
            return redirect('/users')->with('success', 'Login Success');
        }
    
        return redirect()->route('register')->with('error', 'Invalid email or password.');
    }
    
 
    public function logout()
    {
        Auth::logout();
 
        return redirect()->route('register');
    }
}
