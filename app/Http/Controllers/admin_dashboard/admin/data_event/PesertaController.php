<?php

namespace App\Http\Controllers\admin_dashboard\admin\data_event;

use App\Exports\PesertaEventExport;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\RegistrasiEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PesertaController extends Controller
{
    public function index(Request $request, $event_id)
    {
        if ($request->ajax()) {
            $data = RegistrasiEvent::where('event_id', '=', $event_id)->get();
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
                    ->rawColumns([])
                    ->make(true);
        }
        $event = Event::findOrfail($event_id);
        $dataPeserta = RegistrasiEvent::where('event_id', $event_id)->get();
        
        return view('admin_dashboard.admin.data-event.peserta.index', ['event' => $event, 'event_id' => $event_id, 'dataPeserta' => $dataPeserta]);
    }

    public function export($event_id){
        $event = Event::findOrFail($event_id);
        return Excel::download(new PesertaEventExport($event_id), 'Peserta '.$event->nama_event.'.xlsx');
    }
}
