<?php

namespace App\Http\Controllers\admin_dashboard\tutor\kelasku;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\RegistrasiKelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kelas_id, Request $request)
    {
        if ($request->ajax()) {
            $data = RegistrasiKelas::where('kelas_id', '=', $kelas_id)->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('user.nama', function($row){
                        return $row->user->nama;
                    })
                    ->addColumn('umur', function($row){
                        $hari_ini = Carbon::now();
                        $tanggal_lahir = Carbon::parse($row->user->tanggal_lahir);
                        $umur = $tanggal_lahir->diffInYears($hari_ini); 
                        return $umur;
                    })
                    ->addColumn('user.tipe_anggota', function($row){
                        return $row->user->tipe_anggota;
                    })
                    ->addColumn('user.nomor_telepon', function($row){
                        return $row->user->nomor_telepon;
                    })
                    ->addColumn('user.alamat', function($row){
                        return $row->user->alamat. ', ' .ucwords(strtolower(\Indonesia::findVillage($row->user->desa_kelurahan)->name)). ', ' .ucwords(strtolower(\Indonesia::findDistrict($row->user->kecamatan)->name)). ', ' .ucwords(strtolower(\Indonesia::findCity($row->user->kabupaten_kota)->name)). ', ' .ucwords(strtolower(\Indonesia::findProvince($row->user->provinsi)->name));
                    })
                    ->editColumn('status', function($row){
                        if($row->status == 'Diterima'){
                            $status = '<span class="badge badge-success">Diterima</span>';
                        } elseif($row->status == 'Ditolak'){
                            $status = '<span class="badge badge-danger">Ditolak</span>';
                        } else {
                            $status = '<span class="badge badge-warning">Belum Diproses</span>';
                        }
                        return '<td class="text-center">'. $status .'</td>';
                    })
                    ->addColumn('aksi', function($row){
                        return '
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#lihat'.$row->id.'" title="Lihat">
                                        <i class="far fa-file-alt"></i>
                                </button>
                            </td>
                        ';
                    })
                    ->rawColumns(['aksi', 'status'])
                    ->make(true);
        }
        $kelas = Kelas::where('tutor_id', Auth::user()->id)->findOrfail($kelas_id);
        $dataPeserta = RegistrasiKelas::where('kelas_id', $kelas_id)->get();
        
        return view('admin_dashboard.tutor.kelasku.peserta.index', ['kelas' => $kelas, 'kelas_id' => $kelas_id, 'dataPeserta' => $dataPeserta]);
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
    public function update(Request $request, $kelas_id, $id)
    {
        if($request->status == "Ditolak"){
            $this->validate($request, [
                'status' => 'required',
                'catatan' => 'required',
            ]);
        } else {            
            $this->validate($request, [
                'status' => 'required',
            ]);
        }

        $data = $request->all();
        $dataPeserta = RegistrasiKelas::findOrFail($id);
        $dataPeserta->update($data);

        return redirect()->route('tutor.kelasku.peserta.index', $kelas_id)->with('status', 'Data berhasil diperbarui');
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
