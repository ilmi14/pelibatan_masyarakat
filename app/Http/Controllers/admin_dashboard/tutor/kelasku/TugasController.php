<?php

namespace App\Http\Controllers\admin_dashboard\tutor\kelasku;

use App\Http\Controllers\Controller;
use App\Models\JawabanTugas;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\UploadJawabanTugas;
use App\Models\UploadTugas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kelas_id, Request $request)
    {
        $tugas = Tugas::where('kelas_id', '=', $kelas_id)->get();
        if ($request->ajax()) {
            return DataTables::of($tugas)
                    ->addIndexColumn()
                    ->editColumn('batas_waktu', function($row){
                        return Carbon::parse($row->batas_waktu)->format('j F Y H:i');
                    })
                    ->addColumn('aksi', function($row){
                        return '
                            <td class="text-center">
                                <a href="'.route('tutor.kelasku.tugas.show', [$row->kelas_id, $row->id]).'" class="btn btn-sm btn-info" title="Lihat"><i class="far fa-eye"></i></a>
                                <a href="'.route('tutor.kelasku.tugas.edit', [$row->kelas_id, $row->id]).'" class="btn btn-sm btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" id="konfirmasiHapus'.$row->id.'" onclick="confirmDelete(this)" data-id="'.$row->id.'" title="Hapus"><i class="far fa-trash-alt"></i></button>
                            </td>
                        ';
                    })
                    ->rawColumns(['aksi', 'status'])
                    ->make(true);
        }
        $kelas = Kelas::where('tutor_id', Auth::user()->id)->findOrfail($kelas_id);
        
        return view('admin_dashboard.tutor.kelasku.tugas.index', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'tugas' => $tugas]);
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
    public function store($kelas_id, Request $request)
    {
        $this->validate($request, [
            'nama_tugas' => 'required',
            'deskripsi' => 'required',
            'batas_waktu' => 'required',
        ]);

        $data = $request->all();
        $data['kelas_id'] = $kelas_id;
        $tugas = Tugas::create($data);

        if ($request->file('tugas')){
            foreach ($request->file('tugas') as $file) {
                //get filename with extension
                $filenamewithextension = $file->getClientOriginalName();
            
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        
                //get file extension
                $extension = $file->getClientOriginalExtension();
        
                //filename to store
                $filenametostore = $filename.'_'.time().'.'.$extension;

                $data['tugas'] = $file->storeAs('tugas', $filenametostore, 'public');
                
                $data['tugas_id'] = $tugas->id;
                UploadTugas::create($data);
            }
        }

        return redirect('/tutor/kelasku/'.$kelas_id.'/tugas')->with('status', 'Tugas Berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kelas_id, $id)
    {
        $kelas = Kelas::where('tutor_id', Auth::user()->id)->findOrfail($kelas_id);
        $tugas = Tugas::findOrFail($id);
        // $jawabanTugas = JawabanTugas::where('tugas_id', '=', $id)->get();
        $jawaban = User::select('users.*', 'jawaban_tugas.id AS jawaban_id', 'jawaban_tugas.nilai AS nilai')
            ->rightJoin('registrasi_kelas', 'users.id', '=', 'registrasi_kelas.user_id')
            ->leftJoin('jawaban_tugas', 'jawaban_tugas.users_id', '=', DB::raw('users.id AND jawaban_tugas.tugas_id = ' . $id))
            ->where('users.level', 'peserta')->get();
        // return view('admin_dashboard.tutor.kelasku.tugas.show', ['kelas' => $kelas, 'tugas' => $tugas, 'jawabanTugas' => $jawabanTugas, 'tugasBelum' => $tugasBelum]);
        return view('admin_dashboard.tutor.kelasku.tugas.show', ['kelas' => $kelas, 'tugas' => $tugas, 'jawaban' => $jawaban]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kelas_id, $id)
    {
        $kelas = Kelas::where('tutor_id', Auth::user()->id)->findOrfail($kelas_id);
        $tugas = Tugas::findOrFail($id);
        return view('admin_dashboard.tutor.kelasku.tugas.edit', ['kelas' => $kelas, 'tugas' => $tugas]);
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
            'nama_tugas' => 'required',
            'deskripsi' => 'required',
            'batas_waktu' => 'required',
        ]);

        $tugas = Tugas::with('uploadTugas')->findOrFail($id);
        
        $data = $request->all();

        if ($request->file('tugas')) {
            foreach ($tugas->uploadTugas as $item) {
                Storage::disk('public')->delete($item->tugas);
                $item->delete();
            }

            foreach ($request->file('tugas') as $file) {
                //get filename with extension
                $filenamewithextension = $file->getClientOriginalName();
            
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        
                //get file extension
                $extension = $file->getClientOriginalExtension();
        
                //filename to store
                $filenametostore = $filename.'_'.time().'.'.$extension;

                $data['tugas'] = $file->storeAs('tugas', $filenametostore, 'public');
                
                $data['tugas_id'] = $tugas->id;
                UploadTugas::create($data);
            }
        }

        $tugas->update($data);

        return redirect()->route('tutor.kelasku.tugas.index', $kelas_id)->with('status', 'Tugas Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kelas_id, $id)
    {
        $data = Tugas::with('uploadTugas')->with('jawabanTugas')->findOrFail($id);
        $jawaban = JawabanTugas::whereIn('tugas_id', [$id])->get('id');
        $uploadJawabanTugas = UploadJawabanTugas::whereIn('jawaban_tugas_id', $jawaban)->get();

        if ($data->uploadTugas->count() > 0) {
            foreach ($data->uploadTugas as $uploadTugas) {
                Storage::disk('public')->delete($uploadTugas->tugas);
                $uploadTugas->delete();
            }
        }
        
        if($uploadJawabanTugas->count() > 0){
            foreach ($uploadJawabanTugas as $item) {
                Storage::disk('public')->delete($item->jawaban_tugas);
                $item->delete();
            }
        }

        if ($data->jawabanTugas->count() > 0) {
            foreach ($data->jawabanTugas as $jawabanTugas) {
                $jawabanTugas->delete();
            }
        }

        $data->delete();

        return response()->json(array('success' => true));
    }

    public function periksaTugas($kelas_id, $tugas_id, $id){
        $kelas = Kelas::findOrfail($kelas_id);
        $tugas = Tugas::findOrFail($tugas_id);
        $jawabanTugas = JawabanTugas::where('tugas_id', '=', $tugas_id)->findOrFail($id);

        return view('admin_dashboard.tutor.kelasku.tugas.periksa-tugas', ['kelas' => $kelas, 'tugas' => $tugas, 'jawabanTugas' => $jawabanTugas]);
    }

    public function periksaTugasStore(Request $request, $kelas_id, $tugas_id, $id){
        $this->validate($request, [
            'nilai' => 'required',
        ]);

        $jawabanTugas = JawabanTugas::with('uploadJawabanTugas')->findOrFail($id);
        $data = $request->all();
        $data['status'] = 'Dinilai';

        $jawabanTugas->update($data);

        return redirect()->route('tutor.kelasku.tugas.show', [$kelas_id, $tugas_id])->with('status', 'Tugas Berhasil Dinilai');
    }
}
