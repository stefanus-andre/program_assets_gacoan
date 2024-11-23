<?php



namespace App\Http\Controllers\User;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;



class UserAccountController extends Controller

{

    public function Index() {

        return view('User.user_dashboard');

    }

}

