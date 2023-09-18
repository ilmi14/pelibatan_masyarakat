<?php

namespace App\Http\Controllers\admin_dashboard\tutor\kelasku;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

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
                            <a href="'.route('tutor.kelasku.quiz.soal.index', [$row->kelas_id, $row->id]).'" class="btn btn-sm btn-primary" title="kelola soal"><i class="far fa-list-alt"></i></a>
                        ';
                    })
                    ->addColumn('hasil_nilai', function($row){
                        return '
                            <a href="'.route('tutor.kelasku.quiz.jawaban.index', [$row->kelas_id, $row->id]).'" class="btn btn-sm btn-info" title="Lihat nilai"><i class="far fa-eye"></i></a>
                        ';
                    })
                    ->addColumn('aktif', function($row){
                        if($row->aktif == 'Y'){
                            $aktif = '<a href="'.route('tutor.kelasku.quiz.aktif', [$row->kelas_id, $row->id]).'" class="badge badge-pill badge-success">Aktif</a>';
                        } else {
                            $aktif = '<a href="'.route('tutor.kelasku.quiz.aktif', [$row->kelas_id, $row->id]).'" class="badge badge-pill badge-danger">Tidak Aktif</a>';
                        }
                        return $aktif;
                    })
                    ->addColumn('aksi', function($row){
                        return '
                            <td class="text-center">
                                <a href="'.route('tutor.kelasku.quiz.edit', [$row->kelas_id, $row->id]).'" class="btn btn-sm btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" id="konfirmasiHapus'.$row->id.'" onclick="confirmDelete(this)" data-id="'.$row->id.'" title="Hapus"><i class="far fa-trash-alt"></i></button>
                            </td>
                        ';
                    })
                    ->rawColumns(['keterangan', 'soal', 'hasil_nilai', 'aktif', 'aksi'])
                    ->make(true);
        }

        $kelas = Kelas::where('tutor_id', Auth::user()->id)->findOrFail($kelas_id);
        return view('admin_dashboard.tutor.kelasku.quiz.index', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'quiz' => $quiz]);
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
    public function store(Request $request, $kelas_id)
    {
        $this->validate($request, [
            'nama_quiz' => 'required',
            'tanggal_quiz' => 'required',
            'waktu_pengerjaan' => 'required',
            'aktif' => 'required',
        ]);
        $data = $request->all();
        $data['tanggal_quiz'] = Carbon::parse($data['tanggal_quiz'])->format('Y-m-d');
        $data['kelas_id'] = $kelas_id;
        $quiz = Quiz::create($data);

        return redirect()->route('tutor.kelasku.quiz.index',[$kelas_id])->with('status', 'Quiz berhasil dibuat');
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
    public function edit($kelas_id, $id)
    {
        $kelas = Kelas::where('tutor_id', Auth::user()->id)->findOrFail($kelas_id);
        $quiz = Quiz::with('quizSoal')->findOrFail($id);

        return view('admin_dashboard.tutor.kelasku.quiz.edit', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'quiz' => $quiz]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kelas_id, $id)
    {
        $this->validate($request, [
            'nama_quiz' => 'required',
            'tanggal_quiz' => 'required',
            'waktu_pengerjaan' => 'required',
            'aktif' => 'required',
        ]);

        $quiz = Quiz::with('quizSoal')->findOrFail($id);
        
        $data = $request->all();
        $data['tanggal_quiz'] = Carbon::parse($data['tanggal_quiz'])->format('Y-m-d');

        $quiz->update($data);

        return redirect()->route('tutor.kelasku.quiz.index',[$kelas_id])->with('status', 'Quiz berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kelas_id, $id)
    {
        $data = Quiz::with('quizSoal')->with('quizJawaban')->with('quizNilai')->findOrFail($id);
        
        if ($data->quizSoal->count() > 0) {
            foreach ($data->quizSoal as $soal) {
                $soal->delete();
            }
        }

        if ($data->quizJawaban->count() > 0) {
            foreach ($data->quizJawaban as $jawaban) {
                $jawaban->delete();
            }
        }

        if ($data->quizNilai->count() > 0) {
            foreach ($data->quizNilai as $nilai) {
                $nilai->delete();
            }
        }

        $data->delete();

        return response()->json(array('success' => true));
    }

    public function aktif($kelas_id, $id){
        $quiz = Quiz::with('quizSoal')->findOrFail($id);
        
        if ($quiz->aktif == "Y") {
            $aktif = "N";
        } else {
            $aktif = "Y";
        }

        $quiz->update([
            'aktif' => $aktif,
        ]);

        return redirect()->route('tutor.kelasku.quiz.index',[$kelas_id])->with('status', 'Quiz berhasil diperbarui');
    }
}
