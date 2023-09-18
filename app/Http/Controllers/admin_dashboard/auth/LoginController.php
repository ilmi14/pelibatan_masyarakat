<?php

namespace App\Http\Controllers\admin_dashboard\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function postLogin(Request $request){
        if(Auth::attempt($request->only('username', 'password'))){
            if (Auth::user()->level == 'admin') {
                return redirect('admin/dashboard');
            } elseif (Auth::user()->level == 'tutor'){
                return redirect('tutor/dashboard');
            } else {
                return redirect('peserta/dashboard');
            }
        }
        return redirect('/login')->with('status', 'Username atau Password salah')->withInput();
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
