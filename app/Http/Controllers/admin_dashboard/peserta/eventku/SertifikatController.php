<?php

namespace App\Http\Controllers\admin_dashboard\peserta\eventku;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\RegistrasiEvent;
use App\Models\Testimoni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;

class SertifikatController extends Controller
{
    public function index($event_id){
        $event = Event::findOrFail($event_id);
        $registrasiEvent = RegistrasiEvent::where('event_id', $event_id)->where('user_id', Auth::user()->id)->firstOrFail();
        if($registrasiEvent->sertifikat == "Terbit"){
            return view('admin_dashboard.peserta.eventku.sertifikat.index', ['event' => $event]);
        } else {
            abort(404);
        }
    }

    public function store(Request $request, $kelas_id){
        // $data = '';
        
        // $data['kelas_id'] = $kelas_id;
        // $data['user_id'] = Auth::user()->id;
        // $data['kode_sertifikat'] = Str::random(12);
        // dd($data);
        // Post::create($data);
        
        // return redirect()->route('tutor.eventku.forum.index', $kelas_id)->with('status', 'Forum diskusi berhasil dibuat');
    }

    public function show($event_id){
        $registrasiEvent = RegistrasiEvent::where('event_id', $event_id)->where('user_id', Auth::user()->id)->firstOrFail();
        if($registrasiEvent->sertifikat == "Terbit"){
            $nama = Auth::user()->nama;
            $event = Event::findOrFail($event_id);
            $data = [
                // 'kode_sertifikat' => Str::upper(Str::random(12)),
                'nama' => $nama,
                'event' => $event,
                'tanggal' => Carbon::now()->format('Y-m-d')
            ];
            
            $pdf = PDF::loadView('sertifikat/SertifikatEvent', $data)->setPaper('A4', 'landscape');
            
            return $pdf->download('Sertifikat_'.$event->nama_event.'_'.$nama.'.pdf');
            // return $pdf->stream('Sertifikat_'.$event->nama_event.'_'.$nama.'.pdf');
        } else {
            abort(404);
        }
    }
}
