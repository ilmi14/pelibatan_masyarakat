<?php

namespace App\Http\Controllers\admin_dashboard\peserta\kelasku;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\RegistrasiKelas;
use App\Models\Sertifikat;
use App\Models\Testimoni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;

class SertifikatController extends Controller
{
    public function index($kelas_id){
        $kelas = Kelas::findOrFail($kelas_id);
        $testimoni = Testimoni::where('kelas_id', $kelas_id)->where('user_id', Auth::user()->id)->first();
        $registrasiKelas = RegistrasiKelas::where('kelas_id', $kelas_id)->where('user_id', Auth::user()->id)->firstOrFail();
        if($testimoni != null && $registrasiKelas->sertifikat == "Terbit"){
            return view('admin_dashboard.peserta.kelasku.sertifikat.index', ['kelas' => $kelas]);
        } elseif($testimoni != null && $registrasiKelas->sertifikat == "Tidak Terbit") {
            abort(404);
        } else {
            // return redirect()->route('peserta.kelasku.testimoni.create', [$kelas_id])->with('status', 'Mohon isikan testimoni terlebih dahulu sebelum mendapatkan sertifikat');
            return redirect('peserta/kelasku/'.$kelas_id.'/testimoni/create?next=sertifikat')->with('status', 'Mohon isikan testimoni terlebih dahulu sebelum mendapatkan sertifikat');
        }
    }

    public function store(Request $request, $kelas_id){
        // $data = '';
        
        // $data['kelas_id'] = $kelas_id;
        // $data['user_id'] = Auth::user()->id;
        // $data['kode_sertifikat'] = Str::random(12);
        // dd($data);
        // Post::create($data);
        
        // return redirect()->route('tutor.kelasku.forum.index', $kelas_id)->with('status', 'Sertifikat berhasil dibuat');
    }

    public function show($kelas_id){
        $testimoni = Testimoni::where('kelas_id', $kelas_id)->where('user_id', Auth::user()->id)->first();
        $registrasiKelas = RegistrasiKelas::where('kelas_id', $kelas_id)->where('user_id', Auth::user()->id)->firstOrFail();

        if($testimoni != null && $registrasiKelas->sertifikat == "Terbit"){
            $nama = Auth::user()->nama;
            $kelas = Kelas::findOrFail($kelas_id);
            $namaKelas = preg_replace('~\\s+\\S+$~', "", $kelas->nama_kelas);
            $data = [
                // 'kode_sertifikat' => Str::upper(Str::random(12)),
                'nama' => $nama,
                'kelas' => $kelas,
                'namaKelas' => $namaKelas,
            ];
            
            $pdf = PDF::loadView('sertifikat/SertifikatKelas', $data)->setPaper('A4', 'landscape');
            
            return $pdf->download('Sertifikat_'.$kelas->nama_kelas.'_'.$nama.'.pdf');
            // return $pdf->stream('Sertifikat_'.$kelas->nama_kelas.'_'.$nama.'.pdf');
        } else {
            abort(404);
        }
    }
}
