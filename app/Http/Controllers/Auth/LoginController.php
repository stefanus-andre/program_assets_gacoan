<?php



namespace App\Http\Controllers\Auth;



use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Controller\Auth\Redirect;

use App\Http\Controllers\Auth\View;

use Illuminate\Support\Facades\Auth;





class LoginController extends Controller

{

    public function IndexLogin()
    {

        return view('login');
    }



    public function showLoginForm()
    {

        return view('login');
    }



    public function login(Request $request)

    {

        $request->validate([

            'username' => 'required|string',

            'password' => 'required|string',

        ]);



        // Retrieve user by username

        $user = User::where('username', $request->username)->first();



        // Check if user exists and password matches

        if ($user && $user->password === md5($request->password)) {

            // Log the user in

            Auth::login($user);
            return redirect()->intended('/dashboard')->with('message', 'Admin login successful');


            // Redirect based on role

            // if ($user->role === 'admin') {

            //     return redirect()->intended('/admin/dashboard')->with('message', 'Admin login successful');

            // } elseif ($user->role === 'user') {

            //     return redirect()->intended('/user/dashboard')->with('message', 'User login successful');

            // } elseif ($user->role === 'am') {

            //     return redirect()->intended('/am/dashboard')->with('message', 'AM login successful');

            // } elseif ($user->role === 'ops') {

            //     return redirect()->intended('/ops/dashboard')->with('message','OPS login successful');

            // } elseif ($user->role === 'mnr') {

            //     return redirect()->intended('/mnr/dashboard')->with('message','MNR login successful');

            // } elseif ($user->role === 'taf') {

            //     return redirect()->intended('/taf/dashboard')->with('message','TAF login successful');

            // }  elseif ($user->role === 'rm') {

            //     return redirect()->intended('/rm/dashboard')->with('message','RM login successful');

            // } elseif ($user->role === 'sm') {

            //     return redirect()->intended('/sm/dashboard')->with('message','SM login successful');

            // } elseif ($user->role === 'sdg') {

            //     return redirect()->intended('/sdg/dashboard')->with('message','SM login successful');

            // }
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
