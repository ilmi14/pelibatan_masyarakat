<?php

namespace App\Http\Controllers\admin_dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('periode_event', function($row){
                        return '
                            <div class="row">
                                <div class="col-sm-3">Mulai</div>
                                <div class="col-sm-9">: 
                                    ' . Carbon::parse($row->tanggal_mulai)->format('j F Y H:i') . ' 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Selesai</div>
                                <div class="col-sm-9">: 
                                    ' . Carbon::parse($row->tanggal_berakhir)->format('j F Y H:i') . ' 
                                </div>
                            </div>
                        ';
                    })
                    ->editColumn('deadline_pendaftaran', function($row){
                        return Carbon::parse($row->deadline_pendaftaran)->format('j F Y');
                    })
                    ->addColumn('aksi', function($row){
                        return '
                            <td class="text-center">
                                <a href="'. route('event.edit', $row->id) .'" class="btn btn-sm btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" id="konfirmasiHapus'.$row->id.'" onclick="confirmDelete(this)" data-id="'.$row->id.'" title="Hapus"><i class="far fa-trash-alt"></i></button>
                            </td>
                        ';
                    })
                    ->rawColumns(['aksi', 'periode_event', 'checkbox'])
                    ->make(true);
        }
        
        return view('admin_dashboard.admin.event.index');
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
        $this->validate($request, [
            'banner' => 'image|required|max:10240',
            'nama_event' => 'required',
            'periode_event' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'deadline_pendaftaran' => 'required',
            'kuota' => 'required',
        ]);
        
        $data = $request->all();
        // $data['sisa_kuota'] = $request->kuota;
        
        if ($request->file('banner')){
            //get filename with extension
            $filenamewithextension = $request->file('banner')->getClientOriginalName();
        
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('banner')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $data['banner'] = $request->file('banner')->storeAs('event_banner', $filenametostore, 'public');
        }

        $dates = explode('to', $request->periode_event);
        $startDate = trim($dates[0]);
        $endDate = trim($dates[1]);
        $data['tanggal_mulai'] = $startDate;
        $data['tanggal_berakhir'] = $endDate;
        Event::create($data);

        return redirect()->route('event.index')->with('status', 'Event Berhasil Dibuat');
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
        $event = Event::findOrFail($id);
        return view('admin_dashboard.admin.event.edit', ['event' => $event]);
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
        $this->validate($request, [
            'banner' => 'image|nullable|max:10240',
            'nama_event' => 'required',
            'periode_event' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'deadline_pendaftaran' => 'required',
            'kuota' => 'required',
        ]);
        
        $data = $request->all();

        $dates = explode('to', $request->periode_event);
        $startDate = trim($dates[0]);
        $endDate = trim($dates[1]);
        $data['tanggal_mulai'] = $startDate;
        $data['tanggal_berakhir'] = $endDate;

        $event = Event::findOrFail($id);
        if ($request->file('banner')){
            Storage::disk('public')->delete($event['banner']);
            //get filename with extension
            $filenamewithextension = $request->file('banner')->getClientOriginalName();
        
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('banner')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $data['banner'] = $request->file('banner')->storeAs('event_banner', $filenametostore, 'public');
        }
        $event->update($data);

        return redirect()->route('event.index')->with('status', 'Event berhasil di Perbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        Storage::disk('public')->delete($event->banner);
        $event->delete();

        return response()->json(array('success' => true));
    }
}
