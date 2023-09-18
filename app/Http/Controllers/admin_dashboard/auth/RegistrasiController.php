<?php

namespace App\Http\Controllers\admin_dashboard\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrasiController extends Controller
{
    public function registrasi(){
        return view("auth.registrasi");
    }
    public function postRegistrasi(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'nomor_telepon' => 'required|numeric|unique:users,nomor_telepon',
            'username' => 'required|alpha_dash|unique:users,username',
            'password' => 'required|min:8',
            'konfirmasi_password' => 'required|same:password',
        ]);
        
        $data = $request->all();
        $data['level'] = 'peserta';
        $data['password'] = bcrypt($request->password);
        
        User::create($data);
        
        return redirect()->route('login')->with('success', 'Akun Berhasil Dibuat');
    }
}
