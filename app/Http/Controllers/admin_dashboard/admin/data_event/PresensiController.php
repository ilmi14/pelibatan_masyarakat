<?php

namespace App\Http\Controllers\admin_dashboard\admin\data_event;

use App\Exports\PresensiEventExport;
use App\Http\Controllers\Controller;
use App\Models\DataPresensiEvent;
use App\Models\Event;
use App\Models\PresensiEvent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        $presensi = PresensiEvent::where('event_id', '=', $event_id)->get();
        if ($request->ajax()) {
            return DataTables::of($presensi)
                    ->addIndexColumn()
                    ->addColumn('tanggal', function ($row) {
                        // $angka = 1;
                        // for ($i=1; $i < $row->id; $i++) { 
                        //     $angka++;
                        // }
                        // return 'Kehadiran '.$angka;
                        return Carbon::parse($row->tanggal_mulai)->format('j F Y');
                    })
                    ->editColumn('tanggal_mulai', function($row){
                        return Carbon::parse($row->tanggal_mulai)->format('j F Y H:i');
                    })
                    ->editColumn('tanggal_berakhir', function($row){
                        return Carbon::parse($row->tanggal_berakhir)->format('j F Y H:i');
                    })
                    ->addColumn('aksi', function ($row) {
                        return '
                                <td class="text-center">
                                    <a href="' . route('data-event.presensi.show', [$row->event_id, $row->id]) . '" class="btn btn-sm btn-info" title="Lihat"><i class="far fa-eye"></i></a>
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editPresensi' . $row->id . '" title="Edit">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" id="konfirmasiHapus' . $row->id . '" onclick="confirmDelete(this)" data-id="' . $row->id . '" title="Hapus"><i class="far fa-trash-alt"></i></button>
                                </td>
                            ';
                    })
                    ->rawColumns(['aksi', 'nama'])
                    ->make(true);
        }
        $event = Event::findOrfail($event_id);
        
        return view('admin_dashboard.admin.data-event.presensi.index', ['event' => $event, 'event_id' => $event_id, 'presensi' => $presensi]);
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
    public function store(Request $request, $event_id)
    {
        $this->validate($request, [
            'tanggal' => 'required',
        ]);

        $data = $request->all();
        $data['event_id'] = $event_id;
        $dates = explode('to', $request->tanggal);
        if (count($dates) < 2) {
            return redirect()->back()->withErrors(['error' => 'Mohon isi presensi tutup juga']);
        }
        $startDate = trim($dates[0]);
        $endDate = trim($dates[1]);
        $data['tanggal_mulai'] = $startDate;
        $data['tanggal_berakhir'] = $endDate;
        PresensiEvent::create($data);

        return redirect()->route('data-event.presensi.index', [$event_id])->with('status', 'Presensi Berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($event_id, $id)
    {
        $event = Event::findOrfail($event_id);
        $presensi = PresensiEvent::where('event_id', $event_id)->findOrFail($id);
        // $dataPresensi = DataPresensiEvent::with('user')->where('presensi_event_id', '=', $id)->whereRelation('presensi', 'event_id', '=', $event_id)->whereRelation('user', 'level', '=', 'peserta')->get();
        $dataPresensi = User::select('users.*', 'data_presensi_event.id AS presensi_event_id', 'data_presensi_event.created_at AS waktu_mengisi', 'data_presensi_event.status AS presensi_event_status', 'data_presensi_event.gambar AS gambar')
            ->orderBy('users.nama', 'asc')
            ->rightJoin('registrasi_event', 'users.id', '=', 'registrasi_event.user_id')
            ->leftJoin('data_presensi_event', 'data_presensi_event.user_id', '=', DB::raw('users.id AND data_presensi_event.presensi_event_id = ' . $id))
            ->where('users.level', 'peserta')->get();

        return view('admin_dashboard.admin.data-event.presensi.show', ['event' => $event, 'presensi' => $presensi, 'dataPresensi' => $dataPresensi]);
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
    public function update(Request $request, $event_id, $id)
    {
        $this->validate($request, [
            'tanggal' => 'required',
        ]);

        $data = $request->all();

        $dates = explode('to', $request->tanggal);
        if (count($dates) < 2) {
            return redirect()->back()->withErrors(['error' => 'Mohon isi presensi tutup juga']);
        }
        $startDate = trim($dates[0]);
        $endDate = trim($dates[1]);
        $data['tanggal_mulai'] = $startDate;
        $data['tanggal_berakhir'] = $endDate;

        $presensi = PresensiEvent::findOrFail($id);
        $presensi->update($data);

        return redirect()->route('data-event.presensi.index', [$event_id])->with('status', 'Presensi berhasil di Perbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id, $id)
    {
        $presensiEvent = PresensiEvent::with('dataPresensi')->findOrFail($id);
        
        if ($presensiEvent->dataPresensi->count() > 0) {
            foreach ($presensiEvent->dataPresensi as $item) {
                Storage::disk('public')->delete($item->gambar);
                $item->delete();
            }
        }

        $presensiEvent->delete();

        return response()->json(array('success' => true));
    }

    // public function export($event_id, $id){
    //     $event = Event::findOrFail($event_id);
    //     $presensi = PresensiEvent::findOrFail($id);
    //     return Excel::download(new PresensiEventExport($event_id, $id), 'Presensi '.$event->nama_event.' ('.Carbon::parse($presensi->created_at)->format('j F Y').').xlsx');
    // }

    public function export($event_id, $id){
        $event = Event::findOrFail($event_id);
        $presensi = PresensiEvent::findOrFail($id);
        $dataPresensi = User::select('users.*', 'data_presensi_event.id AS presensi_event_id', 'data_presensi_event.created_at AS waktu_mengisi', 'data_presensi_event.status AS presensi_event_status', 'data_presensi_event.gambar AS gambar')
            ->orderBy('users.nama', 'asc')
            ->rightJoin('registrasi_event', 'users.id', '=', 'registrasi_event.user_id')
            ->leftJoin('data_presensi_event', 'data_presensi_event.user_id', '=', DB::raw('users.id AND data_presensi_event.presensi_event_id = ' . $id))
            ->where('users.level', 'peserta')->get();
        
        $data = [
            'event' => $event,
            'presensi' => $presensi,
            'dataPresensi' => $dataPresensi,
        ];
        
        $pdf = PDF::loadView('pdf/presensiEvent', $data)->setPaper('A4', 'portrait');
        
        return $pdf->download('Presensi '.$event->nama_event.' ('.Carbon::parse($presensi->tanggal_mulai)->format('j F Y').').pdf');
    }
}
