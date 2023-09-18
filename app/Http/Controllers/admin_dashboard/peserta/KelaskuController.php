<?php

namespace App\Http\Controllers\admin_dashboard\peserta;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiKelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KelaskuController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = RegistrasiKelas::with('kelas')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('periode_kelas', function($row){
                        return Carbon::parse($row->kelas->tanggal_mulai)->format('j F Y') . ' - ' . Carbon::parse($row->kelas->tanggal_berakhir)->format('j F Y');
                    })
                    ->addColumn('tutor', function($row){
                        return $row->kelas->tutor->nama;
                    })
                    ->editColumn('status', function($row){
                        if($row->kelas->status == 'Pendaftaran'){
                            $status = '<span class="badge badge-success">Pendaftaran</span>';
                        } elseif($row->kelas->status == 'Kegiatan Berlangsung'){
                            $status = '<span class="badge badge-primary">Kegiatan Berlangsung</span>';
                        } else {
                            $status = '<span class="badge badge-dark">Selesai</span>';
                        }
                        return '<td class="text-center">'. $status .'</td>';
                    })
                    ->addColumn('status_seleksi', function($row){
                        if($row->status == 'Diterima'){
                            $status = '<span class="badge badge-success">Diterima</span>';
                        } elseif($row->status == "Ditolak"){
                            $status = '<span class="badge badge-danger">Ditolak</span>';
                        } else {
                            $status = '<span class="badge badge-info">Sedang Proses Seleksi</span>';
                        }
                        return '<td class="text-center">'. $status .'</td>';
                    })
                    ->addColumn('aksi', function($row){
                        if ($row->kelas->status == "Selesai" && $row->sertifikat == 'Terbit') {
                            return '
                                <td class="text-center">
                                    <a href="'. route('peserta.kelasku.home.index', $row->kelas->id) .'" class="btn btn-sm btn-info" title="Lihat"><i class="far fa-eye"></i></a>
                                </td>
                            ';   
                        } else {
                            return '
                                <td class="text-center">
                                    <a href="'. route('peserta.kelasku.home.index', $row->kelas->id) .'" class="btn btn-sm btn-info" title="Lihat"><i class="far fa-eye"></i></a>
                                </td>
                            ';   
                        }
                    })
                    ->rawColumns(['aksi', 'status', 'status_seleksi'])
                    ->make(true);
        }
        
        return view("admin_dashboard.peserta.kelasku.index");
    }
}
