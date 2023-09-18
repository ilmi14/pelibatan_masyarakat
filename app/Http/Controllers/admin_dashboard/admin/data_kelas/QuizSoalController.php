<?php

namespace App\Http\Controllers\admin_dashboard\admin\data_kelas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Quiz;
use App\Models\QuizSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class QuizSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $kelas_id, $quiz_id)
    {
        $soal = QuizSoal::with('quiz')->where('quiz_id', '=', $quiz_id)->get();
        if ($request->ajax()) {
            return DataTables::of($soal)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" class="cb-child" name="id[]" value='.$row->id.'>';
                })
                ->editColumn('soal', function($row){
                    $soal = $row->soal;
                    $soal .= '<ol type="A">';
                    if($row->kunci_jawaban == 'A') {
                        $soal .= '<li class="text-success">'.$row->a.' <i class="far fa-check-circle"></i></li>';
                        $soal .= '<li>'.$row->b.'</li>';
                        $soal .= '<li>'.$row->c.'</li>';
                        $soal .= '<li>'.$row->d.'</li>';

                    }elseif($row->kunci_jawaban == 'B') {
                        $soal .= '<li>'.$row->a.'</li>';
                        $soal .= '<li class="text-success">'.$row->b.' <i class="far fa-check-circle"></i></li>';
                        $soal .= '<li>'.$row->c.'</li>';
                        $soal .= '<li>'.$row->d.'</li>';
                    }elseif($row->kunci_jawaban == 'C') {
                        $soal .= '<li>'.$row->a.'</li>';
                        $soal .= '<li>'.$row->b.'</li>';
                        $soal .= '<li class="text-success">'.$row->c.' <i class="far fa-check-circle"></i></li>';
                        $soal .= '<li>'.$row->d.'</li>';
                    }elseif($row->kunci_jawaban == 'D') {
                        $soal .= '<li>'.$row->a.'</li>';
                        $soal .= '<li>'.$row->b.'</li>';
                        $soal .= '<li>'.$row->c.'</li>';
                        $soal .= '<li class="text-success">'.$row->d.' <i class="far fa-check-circle"></i></li>';
                    }else{
                        $soal .= '<li>'.$row->a.'</li>';
                        $soal .= '<li>'.$row->b.'</li>';
                        $soal .= '<li>'.$row->c.'</li>';
                        $soal .= '<li>'.$row->d.'</li>';
                    }
                    $soal .= '</ol><br><br>';
                    $soal .= '<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample'.$row->id.'" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Pembahasan</a><br><br>';
                    $soal .= '<div class="collapse" id="collapseExample'.$row->id.'">
                        <div class="card card-body text-dark">
                            '.$row->pembahasan.'
                        </div>
                    </div>';
                    return $soal;
                })
                ->addColumn('aktif', function($row){
                    if($row->aktif == 'Y'){
                        $aktif = '<span class="badge badge-pill badge-success">Aktif</span>';
                    } else {
                        $aktif = '<span class="badge badge-pill badge-danger">Tidak Aktif</span>';
                    }
                    return $aktif;
                })
                ->addColumn('aksi', function($row){
                    return '
                        <td class="text-center">
                            <a href="'.route('data-kelas.quiz.soal.show', [$row->quiz->kelas_id, $row->quiz_id, $row->id]).'" class="btn btn-sm btn-info" title="lihat"><i class="far fa-file-alt"></i></a>
                        </td>
                    ';
                })
                ->rawColumns(['soal', 'aktif', 'aksi', 'checkbox'])
                ->make(true);
        }

        $kelas = Kelas::findOrFail($kelas_id);
        return view('admin_dashboard.admin.data-kelas.quiz.soal.index', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'soal' => $soal, 'quiz_id' => $quiz_id]);
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
        $soal = QuizSoal::with('quiz')->findOrFail($id);
        
        if($soal->file != null){
            $file = explode('.', $soal->file);
            $path = trim($file[0]);
            $extension = trim($file[1]);
            $soal['file_extension'] = $extension;
        }
        
        return view('admin_dashboard.admin.data-kelas.quiz.soal.show', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'soal' => $soal]);
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
