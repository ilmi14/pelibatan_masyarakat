<?php

namespace App\Http\Controllers\admin_dashboard\peserta\kelasku;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\RegistrasiKelas;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kelas_id)
    {
        $testimoni = Testimoni::where('kelas_id', $kelas_id)->where('user_id', Auth::user()->id)->first();
        if($testimoni != null){
            $kelas = Kelas::findOrFail($kelas_id);
            $registrasi = RegistrasiKelas::where('kelas_id', '=', $kelas_id)->where('user_id', Auth::user()->id)->first();
            $testimoni = Testimoni::where('kelas_id', $kelas_id)->where('user_id', Auth::user()->id)->first();
            if ($kelas->status == "Selesai") {
                return view('admin_dashboard.peserta.kelasku.testimoni.index', ['kelas' => $kelas, 'registrasi' => $registrasi, 'testimoni' => $testimoni]);
            } else {
                abort(404);
            }
        } else {
            return redirect()->route('peserta.kelasku.testimoni.create', [$kelas_id]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kelas_id)
    {
        $testimoni = Testimoni::where('kelas_id', $kelas_id)->where('user_id', Auth::user()->id)->first();
        if($testimoni != null){
            return redirect()->route('peserta.kelasku.testimoni.index', [$kelas_id]);
        } else {
            $kelas = Kelas::findOrFail($kelas_id);
            $registrasi = RegistrasiKelas::where('kelas_id', '=', $kelas_id)->where('user_id', Auth::user()->id)->first();
            if ($kelas->status == "Selesai") {
                return view('admin_dashboard.peserta.kelasku.testimoni.create', ['kelas' => $kelas, 'registrasi' => $registrasi]);
            } else {
                abort(404);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $kelas_id)
    {
        $this->validate($request, [
            'rating' => 'required',
            'deskripsi' => 'required'
        ]);
        
        $data = $request->all();
        
        $data['kelas_id'] = $kelas_id;
        $data['user_id'] = Auth::user()->id;

        Testimoni::create($data);
        
        if(!empty($data['next'])){
            if($data['next'] == 'sertifikat'){
                return redirect('peserta/kelasku/'.$kelas_id.'/sertifikat');
            }
        } else {
            return redirect()->route('peserta.kelasku.testimoni.index', $kelas_id)->with('status', 'Testimoni berhasil dibuat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kelas_id, $user_id)
    {
        $this->validate($request, [
            'rating' => 'required',
            'deskripsi' => 'required',
        ]);

        $data = $request->all();

        $testimoni = Testimoni::where('kelas_id', $kelas_id)->where('user_id', $user_id)->first();

        $testimoni->update($data);

        return redirect()->route('peserta.kelasku.testimoni.index', [$kelas_id])->with('status', 'Postingan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
