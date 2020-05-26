<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $req)
    {
        $this->validate($req, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            return redirect(route('dashboard'));
        } else {
            return redirect(route('login'))->with([
                'type' => 'error',
                'message' => 'Email atau Password Tidak Valid'
            ]);
        }
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
    
}
