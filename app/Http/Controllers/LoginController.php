<?php

namespace App\Http\Auth\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterUser;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function IndexLogin() {
        return view('login');
    }
    public function showLoginForm() {
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Retrieve user by username
        $user = MasterUser::where('username', $request->username)->first();

        // Check if user exists and password matches
        if ($user && $user->password === md5($request->password)) {
            // Log the user in
            Auth::login($user);
            
            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard')->with('message', 'Admin login successful');
            } elseif ($user->role === 'user') {
                return redirect()->intended('/user/home')->with('message', 'User login successful');
            }
        }

        // Return error for invalid credentials
        return redirect()->back()->withErrors(['Invalid credentials'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('/');
    }
}