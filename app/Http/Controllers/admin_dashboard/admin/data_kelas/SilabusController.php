<?php

namespace App\Http\Controllers\admin_dashboard\admin\data_kelas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Silabus;
use App\Models\SilabusBab;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class SilabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $kelas_id)
    {
        $silabus = SilabusBab::where('kelas_id', $kelas_id)->get();
        // if ($request->ajax()) {
        //     return DataTables::of($silabus)
        //     ->addIndexColumn()
        //     ->editColumn('created_at', function($row){
        //         return Carbon::parse($row->created_at)->format('Y');
        //     })
        //     ->addColumn('tutor', function($row){
        //         return $row->kelas->tutor->nama;
        //     })
        //     ->addColumn('aksi', function($row){
        //         return '
        //             <td class="text-center">
        //                 <a href="'. route('data-kelas.silabus.download', [$row->kelas_id, $row->id]) .'" class="btn btn-sm btn-info" title="Lihat"><i class="far fa-save"></i></a>
        //             </td>
        //         ';
        //     })
        //     ->rawColumns(['aksi', 'bab'])
        //     ->make(true);
        // }
        // $tutor = User::where('level', 'tutor')->get();
        $kelas = Kelas::findOrFail($kelas_id);
        return view('admin_dashboard.admin.data-kelas.silabus.index', ['silabus' => $silabus, 'kelas' => $kelas]);
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

    public function download($kelas_id){
        $kelas = Kelas::findOrFail($kelas_id);
        $silabusBab = SilabusBab::where('kelas_id',$kelas_id)->get();
        $data = [
            'kelas' => $kelas,
            'silabusBab' => $silabusBab
        ];
        
        $pdf = PDF::loadView('pdf/silabus', $data)->setPaper('A4', 'landscape');
        
        return $pdf->download('Silabus '.$kelas->nama_kelas.'.pdf');
    }
}
