<?php

namespace App\Http\Controllers\admin_dashboard\admin\data_kelas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Presensi;
use App\Models\Quiz;
use App\Models\RegistrasiKelas;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $kelas_id)
    {
        if ($request->ajax()) {
            $data = RegistrasiKelas::where('kelas_id', '=', $kelas_id)->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('user.nama', function($row){
                        return $row->user->nama;
                    })
                    ->editColumn('sertifikat', function($row){
                        if($row->sertifikat == 'Terbit'){
                            $sertifikat = '<span class="badge badge-success">Terbit</span>';
                        } elseif($row->sertifikat == 'Tidak Terbit'){
                            $sertifikat = '<span class="badge badge-danger">Tidak Terbit</span>';
                        } else {
                            $sertifikat = '<span class="badge badge-warning">Belum Diproses</span>';
                        }
                        return '<td class="text-center">'. $sertifikat .'</td>';
                    })
                    ->addColumn('aksi', function($row){
                        return '
                            <td class="text-center">
                                <a href="'.route('data-kelas.sertifikat.show', [$row->kelas->id, $row->user->id]).'" class="btn btn-sm btn-info" title="Edit">
                                    <i class="far fa-edit"></i>
                                </a>
                            </td>
                        ';
                    })
                    ->rawColumns(['aksi', 'sertifikat'])
                    ->make(true);
        }
        $kelas = Kelas::findOrfail($kelas_id);
        $dataPeserta = RegistrasiKelas::where('kelas_id', $kelas_id)->get();
        
        return view('admin_dashboard.admin.data-kelas.sertifikat.index', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'dataPeserta' => $dataPeserta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kelas_id, $user_id)
    {
        $registrasiKelas = RegistrasiKelas::where('kelas_id', $kelas_id)->where('user_id', $user_id)->firstOrFail();
        $kelas = Kelas::findOrfail($kelas_id);
        $presensi = Presensi::leftJoin('data_presensi', 'presensi.id', '=', DB::raw('data_presensi.presensi_id AND data_presensi.user_id = ' . $user_id))->where('kelas_id', $kelas_id)->get();
        $quiz = Quiz::leftJoin('nilai_quiz', 'quiz.id', '=', DB::raw('nilai_quiz.quiz_id AND nilai_quiz.user_id = ' . $user_id))->where('kelas_id', $kelas_id)->get();
        $tugas = Tugas::leftJoin('jawaban_tugas', 'tugas.id', '=', DB::raw('jawaban_tugas.tugas_id AND jawaban_tugas.users_id = ' . $user_id))->where('kelas_id', $kelas_id)->get();
        
        return view('admin_dashboard.admin.data-kelas.sertifikat.show', ['kelas' => $kelas, 'registrasiKelas' => $registrasiKelas, 'presensi' => $presensi, 'quiz' => $quiz, 'tugas' => $tugas, 'user_id' => $user_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        if($request->sertifikat == "Tidak Terbit"){
            $this->validate($request, [
                'sertifikat' => 'required',
                'catatan_sertifikat' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'sertifikat' => 'required',
            ]);
        }

        $data = $request->all();
        $registrasiKelas = RegistrasiKelas::where('kelas_id',$kelas_id)->where('user_id', $user_id)->first();
        $registrasiKelas->update($data);

        return redirect()->route('data-kelas.sertifikat.index', $kelas_id)->with('status', 'Data berhasil diperbarui');
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
