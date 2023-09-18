<?php

namespace App\Http\Controllers\admin_dashboard\admin\silabus;

use App\Http\Controllers\Controller;
use App\Models\Silabus;
use App\Models\SilabusBab;
use App\Models\User;
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
    public function index(Request $request)
    {
        $silabus = Silabus::all();
        if ($request->ajax()) {
            return DataTables::of($silabus)
            ->addIndexColumn()
            ->editColumn('created_at', function($row){
                return Carbon::parse($row->created_at)->format('Y');
            })
            ->addColumn('tutor', function($row){
                return $row->user->nama;
            })
            ->addColumn('aksi', function($row){
                return '
                    <td class="text-center">
                        <a href="'. route('silabus.download', $row->id) .'" class="btn btn-sm btn-info" title="Lihat"><i class="far fa-save"></i></a>
                    </td>
                ';
            })
            ->rawColumns(['aksi', 'bab'])
            ->make(true);
        }
        $tutor = User::where('level', 'tutor')->get();
        return view('admin_dashboard.admin.silabus.index', ['silabus' => $silabus, 'tutor' => $tutor]);
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

    public function download($id){
        $silabus = Silabus::findOrFail($id);
        $silabusBab = SilabusBab::where('silabus_id',$id)->get();
        
        $data = [
            'silabus' => $silabus,
            'silabusBab' => $silabusBab
        ];
        
        $pdf = PDF::loadView('pdf/silabus', $data)->setPaper('A4', 'landscape');
        
        return $pdf->download('Silabus '.$silabus->nama_silabus.' '.Carbon::parse($silabus->created_at)->format('Y').'.pdf');
    }
}
