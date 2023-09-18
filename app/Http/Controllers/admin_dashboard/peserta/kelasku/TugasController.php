<?php

namespace App\Http\Controllers\admin_dashboard\peserta\kelasku;

use App\Http\Controllers\Controller;
use App\Models\JawabanTugas;
use App\Models\Kelas;
use App\Models\RegistrasiKelas;
use App\Models\Tugas;
use App\Models\UploadJawabanTugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kelas_id, Request $request)
    {
        $tugas = Tugas::select('tugas.*', 'jawaban_tugas.status AS status_jawaban')->leftJoin('jawaban_tugas', 'tugas.id', '=', DB::raw('jawaban_tugas.tugas_id AND jawaban_tugas.users_id = ' . Auth::user()->id))
        ->where('kelas_id', $kelas_id)->get();
        // $tugas = Tugas::where('kelas_id', '=', $kelas_id)->get();
        if ($request->ajax()) {
            return DataTables::of($tugas)
                    ->addIndexColumn()
                    ->editColumn('batas_waktu', function($row){
                        return Carbon::parse($row->batas_waktu)->format('j F Y H:i');
                    })
                    ->addColumn('status', function($row){
                        if($row->status_jawaban == 'Dinilai' || $row->status_jawaban == 'Terkirim'){
                            return '
                                <td class="text-center">
                                    <span class="badge badge-success">Terkirim</span>
                                </td
                            ';
                        } else {
                            return '
                                <td class="text-center">
                                    <span class="badge badge-warning">Belum Mengirim</span>
                                </td
                            ';
                        }
                    })
                    ->addColumn('aksi', function($row){
                        return '
                            <td class="text-center">
                                <a href="'.route('peserta.kelasku.tugas.show', [$row->kelas_id, $row->id]).'" class="btn btn-sm btn-info" title="Lihat"><i class="far fa-eye"></i></a>
                            </td>
                        ';
                    })
                    ->rawColumns(['aksi', 'status'])
                    ->make(true);
        }

        $kelas = Kelas::findOrfail($kelas_id);
        $registrasi = RegistrasiKelas::where('kelas_id', '=', $kelas_id)->where('user_id', Auth::user()->id)->first();
        
        return view('admin_dashboard.peserta.kelasku.tugas.index', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'tugas' => $tugas, 'registrasi' => $registrasi]);
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
        $jawabanTugas = JawabanTugas::where('users_id', '=', Auth::user()->id)->where('tugas_id', '=', $id)->first();
        $registrasi = RegistrasiKelas::where('kelas_id', '=', $kelas_id)->where('user_id', Auth::user()->id)->first();
        return view('admin_dashboard.peserta.kelasku.tugas.show', ['kelas' => $kelas, 'tugas' => $tugas, 'jawabanTugas' => $jawabanTugas, 'registrasi' => $registrasi]);
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
    public function update(Request $request, $kelas_id, $id)
    {
        // $this->validate($request, [
        //     'nama_tugas' => 'required',
        //     'deskripsi' => 'required',
        //     'batas_waktu' => 'required',
        // ]);

        $jawabanTugas = JawabanTugas::with('uploadJawabanTugas')->findOrFail($id);
        
        $data = $request->all();

        if ($request->file('jawaban_tugas')) {
            foreach ($jawabanTugas->uploadJawabanTugas as $item) {
                Storage::disk('public')->delete($item->jawaban_tugas);
                $item->delete();
            }

            foreach ($request->file('jawaban_tugas') as $file) {
                //get filename with extension
                $filenamewithextension = $file->getClientOriginalName();
            
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        
                //get file extension
                $extension = $file->getClientOriginalExtension();
        
                //filename to store
                $filenametostore = $filename.'_'.time().'.'.$extension;

                $data['jawaban_tugas'] = $file->storeAs('jawaban_tugas', $filenametostore, 'public');
                
                $data['jawaban_tugas_id'] = $jawabanTugas->id;
                UploadJawabanTugas::create($data);
            }
        }

        $jawabanTugas->update($data);

        return redirect()->route('peserta.kelasku.tugas.show', [$kelas_id, $id])->with('status', 'Jawaban Berhasil Diperbarui');
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
