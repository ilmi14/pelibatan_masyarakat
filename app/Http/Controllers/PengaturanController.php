<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function profil(){
        $peserta = User::where('id', Auth::user()->id)->first();
        return view('admin_dashboard.pengaturan.profil', ['peserta' => $peserta]);
    }

    public function update_profil(Request $request){
        $id = Auth::user()->id;
        if ($request->foto) {
            $this->validate($request, [
                'kelas' => 'image|nullable|max:10240',
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'nomor_telepon' => 'required|numeric|unique:users,nomor_telepon,' . $id,
                'email' => 'required|email|unique:users,email,' . $id,
                'tipe_anggota' => 'required',
                'provinsi' => 'required',
                'kabupaten_kota' => 'required',
                'kecamatan' => 'required',
                'desa_kelurahan' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'nomor_telepon' => 'required|numeric|unique:users,nomor_telepon,' . $id,
                'email' => 'required|email|unique:users,email,' . $id,
                'tipe_anggota' => 'required',
                'provinsi' => 'required',
                'kabupaten_kota' => 'required',
                'kecamatan' => 'required',
                'desa_kelurahan' => 'required',
            ]);
        }
        $data = $request->all();
        if ($request->file('foto')){
            if(Auth::user()->foto){
                Storage::disk('public')->delete($id['foto']);
            }

            //get filename with extension
            $filenamewithextension = $request->file('foto')->getClientOriginalName();
        
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('foto')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $data['foto'] = $request->file('foto')->storeAs('user', $filenametostore, 'public');
        }
        function nomorTelepon($nomorhp) {
            //Terlebih dahulu kita trim dl
            $nomorhp = trim($nomorhp);
            //bersihkan dari karakter yang tidak perlu
            $nomorhp = strip_tags($nomorhp);     
            // Berishkan dari spasi
            $nomorhp= str_replace(" ","",$nomorhp);
            // bersihkan dari bentuk seperti  (022) 66677788
            $nomorhp= str_replace("(","",$nomorhp);
            // bersihkan dari format yang ada titik seperti 0811.222.333.4
            $nomorhp= str_replace(".","",$nomorhp); 
       
            //cek apakah mengandung karakter + dan 0-9
            if(!preg_match('/[^+0-9]/',trim($nomorhp))){
                // cek apakah no hp karakter 1-3 adalah +62
                if(substr(trim($nomorhp), 0, 3)=='+62'){
                    $nomorhp= trim($nomorhp);
                }
                // cek apakah no hp karakter 1 adalah 0
                elseif(substr($nomorhp, 0, 1)=='0'){
                    $nomorhp= '+62'.substr($nomorhp, 1);
                }
            }
            return $nomorhp;
        }
        $data['nomor_telepon'] = nomorTelepon($request->nomor_telepon);
        $data['status'] = "Sudah Verifikasi";
        $tutor = User::findOrFail($id);
        $tutor->update($data);

        if (Auth::user()->level == "admin") {
            return redirect('/admin/profil')->with('status', 'Profil Berhasil diperbarui');
        } elseif (Auth::user()->level == "tutor") {
            return redirect('/tutor/profil')->with('status', 'Profil berhasil diperbarui');
        } else {
            return redirect('/peserta/profil')->with('status', 'Profil berhasil diperbarui');
        }
    }

    public function akun(){
        $peserta = User::where('id', Auth::user()->id)->first();
        return view('admin_dashboard.pengaturan.akun', ['peserta' => $peserta]);
    }

    public function update_akun(Request $request){
        $id = Auth::user()->id;
        if($request->username){
            $this->validate($request, [
                'username' => 'required|alpha_dash|unique:users,username,' . $id,
            ]);

            $data = $request->all();
            $user = User::findOrFail($id);
            $user->update($data);

            if (Auth::user()->level == "admin") {
                return redirect('/admin/akun')->with('status', 'Username berhasil disimpan');
            } elseif (Auth::user()->level == "tutor") {
                return redirect('/tutor/akun')->with('status', 'Username berhasil disimpan');
            } else {
                return redirect('/peserta/akun')->with('status', 'Username berhasil disimpan');
            }
        } elseif($request->password) {
            $this->validate($request, [
                'password_lama' => 'required',
                'password' => 'required|min:8',
                'konfirmasi_password' => 'required|same:password',
            ]);

            $user = User::findOrFail($id);
            if (Hash::check($request->password_lama, $user->password)) { 
                $data = $request->all();
                $data['password'] = bcrypt($request->password);
                
                $user->update($data);
                if (Auth::user()->level == "admin") {
                    return redirect('/admin/akun')->with('status', 'Password berhasil disimpan');
                } elseif (Auth::user()->level == "tutor") {
                    return redirect('/tutor/akun')->with('status', 'Password berhasil disimpan');
                } else {
                    return redirect('/peserta/akun')->with('status', 'Password berhasil disimpan');
                }
            } else {
                if (Auth::user()->level == "admin") {
                    return redirect('/admin/akun')->with('error', 'Password lama salah');
                } elseif (Auth::user()->level == "tutor") {
                    return redirect('/tutor/akun')->with('error', 'Password lama salah');
                } else {
                    return redirect('/peserta/akun')->with('error', 'Password lama salah');
                }
            }
        } else {
            if (Auth::user()->level == "admin") {
                return redirect('/admin/akun')->with('status', 'Proses pengubahan tidak berhasil');
            } elseif (Auth::user()->level == "tutor") {
                return redirect('/tutor/akun')->with('status', 'Proses pengubahan tidak berhasil');
            } else {
                return redirect('/peserta/akun')->with('status', 'Proses pengubahan tidak berhasil');
            }
        }
    }
}
