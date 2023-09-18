<?php

namespace App\Http\Controllers\admin_dashboard\peserta;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\RegistrasiEvent;
use App\Models\RegistrasiKelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('sort')) {
            $event = Event::filter(request(['search', 'sort']))->paginate(10);
        } else {
            $event = Event::orderBy('id', 'desc')->filter(request(['search']))->paginate(10);
        }
        
        $search = request('search');
        $sort = request('sort');
        return view('admin_dashboard.peserta.event.index', ['events' => $event, 'search' => $search, 'sort' => $sort]);
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
        $event = Event::findOrfail($id);
        $registrasi_event = RegistrasiEvent::where('user_id', '=', Auth::user()->id)->where('event_id', '=', $event->id)->first();
        $jumlahPendaftar = count(RegistrasiEvent::where('event_id', '=', $event->id)->get());
        $kuota = $event->kuota - $jumlahPendaftar;
        
        return view('admin_dashboard.peserta.event.show', ['event' => $event, 'registrasi_event' => $registrasi_event, 'kuota' => $kuota]);
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

    public function daftar(Request $request, $id){
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['event_id'] = $id;
        RegistrasiEvent::create($data);
        
        return redirect()->route('peserta.event.show', $id)->with('success', 'Berhasil Mendaftar event');
    }
}
