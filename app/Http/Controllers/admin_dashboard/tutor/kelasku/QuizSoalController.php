<?php

namespace App\Http\Controllers\admin_dashboard\tutor\kelasku;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Quiz;
use App\Models\QuizSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
                        $aktif = '<a href="'.route('tutor.kelasku.quiz.soal.aktif', [$row->quiz->kelas_id, $row->quiz_id, $row->id]).'" class="badge badge-pill badge-success">Aktif</a>';
                    } else {
                        $aktif = '<a href="'.route('tutor.kelasku.quiz.soal.aktif', [$row->quiz->kelas_id, $row->quiz_id, $row->id]).'" class="badge badge-pill badge-danger">Tidak Aktif</a>';
                    }
                    return $aktif;
                })
                ->addColumn('aksi', function($row){
                    return '
                        <td class="text-center">
                            <a href="'.route('tutor.kelasku.quiz.soal.show', [$row->quiz->kelas_id, $row->quiz_id, $row->id]).'" class="btn btn-sm btn-info" title="lihat"><i class="far fa-file-alt"></i></a>
                            <a href="'.route('tutor.kelasku.quiz.soal.edit', [$row->quiz->kelas_id, $row->quiz_id, $row->id]).'" class="btn btn-sm btn-warning" title="edit"><i class="far fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger" id="konfirmasiHapus'.$row->id.'" onclick="confirmDelete(this)" data-id="'.$row->id.'" title="Hapus"><i class="far fa-trash-alt"></i></button>
                        </td>
                    ';
                })
                ->rawColumns(['soal', 'aktif', 'aksi', 'checkbox'])
                ->make(true);
        }

        $kelas = Kelas::where('tutor_id', Auth::user()->id)->findOrFail($kelas_id);
        $quiz = Quiz::findOrFail($quiz_id);
        return view('admin_dashboard.tutor.kelasku.quiz.soal.index', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'soal' => $soal, 'quiz_id' => $quiz_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kelas_id, $quiz_id)
    {
        $kelas = Kelas::where('tutor_id', Auth::user()->id)->findOrFail($kelas_id);
        $quiz = Quiz::findOrFail($quiz_id);
        return view('admin_dashboard.tutor.kelasku.quiz.soal.create', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'quiz' => $quiz]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $kelas_id, $quiz_id)
    {
        $this->validate($request, [
            "soal"   => "required|array",
            "soal.*" => "required|string",
            "a"   => "required|array",
            "a.*" => "required|string",
            "b"   => "required|array",
            "b.*" => "required|string",
            "c"   => "required|array",
            "c.*" => "required|string",
            "d"   => "required|array",
            "d.*" => "required|string",
            "kunci_jawaban"   => "required|array",
            "kunci_jawaban.*" => "required|string",
            "file"   => "array",
            "file.*" => "mimetypes:video/*,audio/*,image/*",
        ]);

        $soal = $request->soal;
        $a = $request->a;
        $b = $request->b;
        $c = $request->c;
        $d = $request->d;
        $kunci_jawaban = $request->kunci_jawaban;
        $pembahasan = $request->pembahasan;
        $total = count($soal);

        if ($request->file('file')){
            foreach($request->file('file') as $key=>$data){
                //get filename with extension
                $filenamewithextension = $data->getClientOriginalName();
            
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        
                //get file extension
                $extension = $data->getClientOriginalExtension();
        
                //filename to store
                $filenametostore = $filename.'_'.time().'.'.$extension;

                $file[$key] = $data->storeAs('soal_quiz', $filenametostore, 'public');
                // $file[$key] = $data->store('soal_quiz', 'public');
            }
        }

        for($i=0;$i<$total;$i++){
            if(!empty($file[$i])) { 
                QuizSoal::create([
                    'quiz_id' => $quiz_id,
                    'soal' => $soal[$i],
                    'a' => $a[$i],
                    'b' => $b[$i],
                    'c' => $c[$i],
                    'd' => $d[$i],
                    'kunci_jawaban' => $kunci_jawaban[$i],
                    'pembahasan' => $pembahasan[$i],
                    'file' => $file[$i],
                    'aktif' => 'Y',
                ]);
            } else {
                QuizSoal::create([
                    'quiz_id' => $quiz_id,
                    'soal' => $soal[$i],
                    'a' => $a[$i],
                    'b' => $b[$i],
                    'c' => $c[$i],
                    'd' => $d[$i],
                    'kunci_jawaban' => $kunci_jawaban[$i],
                    'pembahasan' => $pembahasan[$i],
                    'file' => null,
                    'aktif' => 'Y',
                ]);
            }
        }
        
        return redirect()->route('tutor.kelasku.quiz.soal.index',[$kelas_id, $quiz_id])->with('status', 'Soal quiz berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kelas_id, $quiz_id, $id)
    {
        $kelas = Kelas::where('tutor_id', Auth::user()->id)->findOrFail($kelas_id);
        $soal = QuizSoal::with('quiz')->findOrFail($id);
        
        if($soal->file != null){
            $file = explode('.', $soal->file);
            $path = trim($file[0]);
            $extension = trim($file[1]);
            $soal['file_extension'] = $extension;
        }
        
        return view('admin_dashboard.tutor.kelasku.quiz.soal.show', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'soal' => $soal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kelas_id, $quiz_id, $id)
    {
        $kelas = Kelas::where('tutor_id', Auth::user()->id)->findOrFail($kelas_id);
        $soal = QuizSoal::with('quiz')->findOrFail($id);

        if($soal->file != null){
            $file = explode('.', $soal->file);
            $path = trim($file[0]);
            $extension = trim($file[1]);
            $soal['file_extension'] = $extension;
        }
        
        return view('admin_dashboard.tutor.kelasku.quiz.soal.edit', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'soal' => $soal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kelas_id, $quiz_id, $id)
    {
        if( $request->hasFile('file') ) {
            $file = $request->file('file');
            $imagemimes = ['image/png', 'image/jpg', 'image/jpeg']; //Add more mimes that you want to support
            $videomimes = ['video/mp4']; //Add more mimes that you want to support
            $audiomimes = ['audio/mpeg']; //Add more mimes that you want to support
    
            if(in_array($file->getMimeType() ,$imagemimes)) {
                $filevalidate = 'required|mimes:jpeg,jpg,png|max:2048';
            }
            //Validate video
            if (in_array($file->getMimeType() ,$videomimes)) {
                $filevalidate = 'required|mimes:mp4';
            }
            //validate audio
            if (in_array($file->getMimeType() ,$audiomimes)) {
                $filevalidate = 'required|mimes:mpeg';
            }		
            $this->validate($request, [
                "soal"   => "required",
                "a"   => "required",
                "b"   => "required",
                "c"   => "required",
                "d"   => "required",
                "kunci_jawaban"   => "required",
                "file" => $filevalidate,
            ]);
        }
        $this->validate($request, [
            "soal"   => "required",
            "a"   => "required",
            "b"   => "required",
            "c"   => "required",
            "d"   => "required",
            "kunci_jawaban"   => "required",
        ]);

        $soal = QuizSoal::with('quiz')->findOrFail($id);
        
        $data = $request->all();
        
        if ($request->file('file')) {
            Storage ::disk('public')->delete($soal->file);

            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();
        
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $data['file'] = $request->file('file')->storeAs('soal_quiz', $filenametostore, 'public');
        }

        $soal->update($data);

        return redirect()->route('tutor.kelasku.quiz.soal.index',[$kelas_id, $quiz_id])->with('status', 'Soal quiz berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kelas_id, $quiz_id, $id)
    {
        $data = QuizSoal::findOrFail($id);

        Storage::disk('public')->delete($data->file);

        $data->delete();

        return response()->json(array('success' => true));
    }

    public function aktif($kelas_id, $soal_id, $id){
        $quiz = QuizSoal::findOrFail($id);
        
        if ($quiz->aktif == "Y") {
            $aktif = "N";
        } else {
            $aktif = "Y";
        }

        $quiz->update([
            'aktif' => $aktif,
        ]);

        return redirect()->route('tutor.kelasku.quiz.soal.index',[$kelas_id, $soal_id])->with('status', 'Quiz berhasil diperbarui');
    }

    public function status(Request $request, $kelas_id, $quiz_id){
        $this->validate($request, [
            "aktif"   => ["required", Rule::in(['Y', 'N'])],
        ]);
        $quizSoal = QuizSoal::whereIn('id',$request->ids)->update(['aktif' => $request->aktif]);
        if($quizSoal){
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('success' => false));
        }
    }
}
