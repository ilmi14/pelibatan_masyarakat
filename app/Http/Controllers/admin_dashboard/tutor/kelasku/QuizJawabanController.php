<?php

namespace App\Http\Controllers\admin_dashboard\tutor\kelasku;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\NilaiQuiz;
use App\Models\Quiz;
use App\Models\QuizJawaban;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizJawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $kelas_id, $quiz_id)
    {
        // $jawaban = NilaiQuiz::with('users')->with('quiz')->where('quiz_id', $quiz_id)->get();
        $jawaban = User::select('users.nama AS nama', 'nilai_quiz.*', 'registrasi_kelas.kelas_id')
            ->rightJoin('registrasi_kelas', 'users.id', '=', 'registrasi_kelas.user_id')
            ->leftJoin('nilai_quiz', 'users.id', '=', DB::raw('nilai_quiz.user_id AND nilai_quiz.quiz_id = ' . $quiz_id))
            ->where('users.level', 'peserta')->get();
        
        if ($request->ajax()) {
            return DataTables::of($jawaban)
                    ->addIndexColumn()
                    ->addColumn('nama', function($row){
                        return $row->nama;
                    })
                    ->addColumn('aksi', function($row){
                        if ($row->quiz_id != null && $row->user_id != null){
                            return '
                                <td class="text-center">
                                    <a href="' . route('tutor.kelasku.quiz.jawaban.show', [$row->kelas_id, $row->quiz_id, $row->user_id]) . '" class="btn btn-sm btn-info" title="Lihat nilai"><i class="far fa-eye"></i></a>
                                </td>
                            ';
                        }
                    })
                    ->editColumn('nilai', function($row){
                        if($row->nilai != null){
                            return $row->nilai.'%';
                        }
                    })
                    ->rawColumns(['nama', 'aksi'])
                    ->make(true);
        }

        $kelas = Kelas::where('tutor_id', Auth::user()->id)->findOrFail($kelas_id);
        return view('admin_dashboard.tutor.kelasku.quiz.jawaban.index', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'quiz_id' => $quiz_id]);
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
    public function show($kelas_id, $quiz_id, $id)
    {
        $kelas = Kelas::findOrFail($kelas_id);
        $informasiQuiz = Quiz::findOrFail($quiz_id);
        $quiz = QuizJawaban::with('quizSoal')->where('quiz_id', $quiz_id)->where('user_id', $id)->get();
        $hasil = NilaiQuiz::with('users')->where('quiz_id', $quiz_id)->where('user_id', $id)->firstOrFail();
        
        foreach ($quiz as $jawaban){
            $soal = $jawaban->quizSoal;
            
            if ($soal->file != null) {
                $file = explode('.', $soal->file);
                $path = trim($file[0]);
                $extension = trim($file[1]);
                $soal['file_extension'] = $extension;
            }
        }

        return view('admin_dashboard.tutor.kelasku.quiz.jawaban.show', ['kelas' => $kelas, 'quiz' => $quiz, 'informasiQuiz' =>  $informasiQuiz, 'hasil' => $hasil]);
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
