<?php

namespace App\Http\Controllers\admin_dashboard\peserta;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EventkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data = RegistrasiEvent::with('event')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('periode_event', function($row){
                        return '
                            <div class="row">
                                <div class="col-sm-3">Mulai</div>
                                <div class="col-sm-9">: 
                                    ' . Carbon::parse($row->event->tanggal_mulai)->format('j F Y H:i') . ' 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Selesai</div>
                                <div class="col-sm-9">: 
                                    ' . Carbon::parse($row->event->tanggal_berakhir)->format('j F Y H:i') . ' 
                                </div>
                            </div>
                        ';
                    })
                    ->addColumn('aksi', function($row){
                        if ($row->sertifikat == 'Terbit') {
                            return '
                                <td class="text-center">
                                    <a href="'. route('peserta.eventku.deskripsi.index', $row->event->id) .'" class="btn btn-sm btn-info" title="Lihat"><i class="far fa-eye"></i></a>
                                </td>
                            ';   
                        } else {
                            return '
                                <td class="text-center">
                                    <a href="'. route('peserta.eventku.deskripsi.index', $row->event->id) .'" class="btn btn-sm btn-info" title="Lihat"><i class="far fa-eye"></i></a>
                                </td>
                            ';   
                        }
                    })
                    ->rawColumns(['aksi', 'periode_event'])
                    ->make(true);
        }
        
        return view("admin_dashboard.peserta.eventku.index");
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
}
