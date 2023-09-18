<?php

namespace App\Http\Controllers\admin_dashboard\admin\data_event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\PresensiEvent;
use App\Models\RegistrasiEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        $event = Event::findOrfail($event_id);
        if(Carbon::now()->format('Y-m-d') > $event->tanggal_berakhir){
            $dataPeserta = RegistrasiEvent::where('event_id', $event_id)->get();
            if ($request->ajax()) {
                return DataTables::of($dataPeserta)
                        ->addIndexColumn()
                        ->addColumn('user.nama', function($row){
                            return $row->user->nama;
                        })
                        ->editColumn('sertifikat', function($row){
                            if($row->sertifikat == 'Terbit'){
                                $sertifikat = '<span class="badge badge-success">Terbit</span>';
                            } elseif($row->sertifikat == 'Tidak Terbit'){
                                $sertifikat = '<span class="badge badge-danger">Tidak Terbit</span>';
                            } else {
                                $sertifikat = '<span class="badge badge-warning">Belum Diproses</span>';
                            }
                            return '<td class="text-center">'. $sertifikat .'</td>';
                        })
                        ->addColumn('aksi', function($row){
                            return '
                                <td class="text-center">
                                    <a href="'.route('data-event.sertifikat.show', [$row->event->id, $row->user->id]).'" class="btn btn-sm btn-info" title="Edit">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </td>
                            ';
                        })
                        ->rawColumns(['aksi', 'sertifikat'])
                        ->make(true);
            }
    
            return view('admin_dashboard.admin.data-event.sertifikat.index', ['event' => $event, 'event_id' => $event_id, 'dataPeserta' => $dataPeserta]);
        } else {
            abort(404);
        }
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
    public function show($event_id, $user_id)
    {
        $event = Event::findOrfail($event_id);
        if(Carbon::now()->format('Y-m-d') > $event->tanggal_berakhir){
            $registrasiEvent = RegistrasiEvent::where('event_id', $event_id)->where('user_id', $user_id)->firstOrFail();
            $presensi = PresensiEvent::leftJoin('data_presensi_event', 'presensi_event.id', '=', DB::raw('data_presensi_event.presensi_event_id AND data_presensi_event.user_id = ' . $user_id))->where('event_id', $event_id)->get();
            return view('admin_dashboard.admin.data-event.sertifikat.show', ['event' => $event, 'registrasiEvent' => $registrasiEvent, 'presensi' => $presensi, 'user_id' => $user_id]);
        } else {
            abort(404);
        }
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
    public function update(Request $request, $event_id, $user_id)
    {
        if($request->sertifikat == "Tidak Terbit"){
            $this->validate($request, [
                'sertifikat' => 'required',
                'catatan_sertifikat' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'sertifikat' => 'required',
            ]);
        }

        $data = $request->all();
        $registrasiEvent = RegistrasiEvent::where('event_id',$event_id)->where('user_id', $user_id)->first();
        $registrasiEvent->update($data);

        return redirect()->route('data-event.sertifikat.index', $event_id)->with('status', 'Data berhasil diperbarui');
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
