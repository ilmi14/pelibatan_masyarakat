<?php

namespace App\Http\Controllers\admin_dashboard\admin\data_kelas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $kelas_id)
    {
        $quiz = Quiz::where('kelas_id', '=', $kelas_id)->get();
        if ($request->ajax()) {
            return DataTables::of($quiz)
                    ->addIndexColumn()
                    ->addColumn('keterangan', function($row){
                        return '
                            Tanggal Quiz : '.Carbon::parse($row->tanggal_quiz)->format('j F Y').',<br>
                            Waktu : '.$row->waktu_pengerjaan.' Menit
                        ';
                    })
                    ->addColumn('soal', function($row){
                        return '
                            <a href="'.route('data-kelas.quiz.soal.index', [$row->kelas_id, $row->id]).'" class="btn btn-sm btn-primary" title="Lihat soal"><i class="far fa-list-alt"></i></a>
                        ';
                    })
                    ->addColumn('hasil_nilai', function($row){
                        return '
                            <a href="'.route('data-kelas.quiz.jawaban.index', [$row->kelas_id, $row->id]).'" class="btn btn-sm btn-info" title="Lihat nilai"><i class="far fa-eye"></i></a>
                        ';
                    })
                    ->addColumn('aktif', function($row){
                        if($row->aktif == 'Y'){
                            $aktif = '<span class="badge badge-pill badge-success">Aktif</span>';
                        } else {
                            $aktif = '<span class="badge badge-pill badge-danger">Tidak Aktif</span>';
                        }
                        return $aktif;
                    })
                    ->rawColumns(['keterangan', 'hasil_nilai', 'aktif', 'soal'])
                    ->make(true);
        }

        $kelas = Kelas::findOrFail($kelas_id);
        return view('admin_dashboard.admin.data-kelas.quiz.index', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'quiz' => $quiz]);
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
}
