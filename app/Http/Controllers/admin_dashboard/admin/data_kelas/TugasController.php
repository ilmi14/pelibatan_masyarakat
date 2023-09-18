<?php

namespace App\Http\Controllers\admin_dashboard\admin\data_kelas;

use App\Http\Controllers\Controller;
use App\Models\JawabanTugas;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $kelas_id)
    {
        $tugas = Tugas::where('kelas_id', '=', $kelas_id)->get();
        if ($request->ajax()) {
            return DataTables::of($tugas)
                    ->addIndexColumn()
                    ->addColumn('aksi', function($row){
                        return '
                            <td class="text-center">
                                <a href="'.route('data-kelas.tugas.show', [$row->kelas_id, $row->id]).'" class="btn btn-sm btn-info" title="Lihat"><i class="far fa-eye"></i></a>
                            </td>
                        ';
                    })
                    ->rawColumns(['aksi', 'status'])
                    ->make(true);
        }
        $kelas = Kelas::findOrfail($kelas_id);
        
        return view('admin_dashboard.admin.data-kelas.tugas.index', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'tugas' => $tugas]);
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
    public function show($kelas_id, $id)
    {
        $kelas = Kelas::findOrfail($kelas_id);
        $tugas = Tugas::findOrFail($id);
        // $jawabanTugas = JawabanTugas::where('tugas_id', '=', $id)->get();
        $jawaban = User::select('users.*', 'jawaban_tugas.id AS jawaban_id', 'jawaban_tugas.nilai AS nilai')
            ->rightJoin('registrasi_kelas', 'users.id', '=', 'registrasi_kelas.user_id')
            ->leftJoin('jawaban_tugas', 'jawaban_tugas.users_id', '=', DB::raw('users.id AND jawaban_tugas.tugas_id = ' . $id))
            ->where('users.level', 'peserta')->get();
        // return view('admin_dashboard.admin.data-kelas.tugas.show', ['kelas' => $kelas, 'tugas' => $tugas, 'jawabanTugas' => $jawabanTugas]);
        return view('admin_dashboard.admin.data-kelas.tugas.show', ['kelas' => $kelas, 'tugas' => $tugas, 'jawaban' => $jawaban]);
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
    public function update(Request $request, $id)
    {
        //
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

    public function periksaTugas($kelas_id, $tugas_id, $id){
        $kelas = Kelas::findOrfail($kelas_id);
        $tugas = Tugas::findOrFail($tugas_id);
        $jawabanTugas = JawabanTugas::where('tugas_id', '=', $tugas_id)->findOrFail($id);
        return view('admin_dashboard.admin.data-kelas.tugas.periksa-tugas', ['kelas' => $kelas, 'tugas' => $tugas, 'jawabanTugas' => $jawabanTugas]);
    }
}
