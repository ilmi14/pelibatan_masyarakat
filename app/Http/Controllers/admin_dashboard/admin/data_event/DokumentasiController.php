<?php

namespace App\Http\Controllers\admin_dashboard\admin\data_event;

use App\Http\Controllers\Controller;
use App\Models\Dokumentasi;
use App\Models\Event;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        $dokumentasi = Dokumentasi::where('event_id', '=', $event_id)->orderBy('tipe', 'ASC')->orderBy('nama_file', 'ASC')->get();
        if ($request->ajax()) {
            return DataTables::of($dokumentasi)
                    ->addIndexColumn()
                    ->addColumn('aksi', function($row){
                        if($row->tipe == "Slideshare"){
                            return '
                                <td class="text-center">
                                    <a href="'.route('data-event.dokumentasi.edit', [$row->event_id, $row->id]).'" class="btn btn-sm btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger" id="konfirmasiHapus'.$row->id.'" onclick="confirmDelete(this)" data-id="'.$row->id.'" title="Hapus"><i class="far fa-trash-alt"></i></button>
                                </td>
                            ';
                        } else {
                            return '
                                <td class="text-center">
                                    <a href="'.route('dokumentasi.download', [$row->event_id, $row->id]).'" class="btn btn-sm btn-primary" title="Download File">
                                        <i class="far fa-save"></i>
                                    </a>
                                    <a href="'.route('data-event.dokumentasi.edit', [$row->event_id, $row->id]).'" class="btn btn-sm btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger" id="konfirmasiHapus'.$row->id.'" onclick="confirmDelete(this)" data-id="'.$row->id.'" title="Hapus"><i class="far fa-trash-alt"></i></button>
                                </td>
                            ';
                        }
                    })
                    ->rawColumns(['aksi', 'status'])
                    ->make(true);
        }
        $event = Event::findOrfail($event_id);
        
        return view('admin_dashboard.admin.data-event.dokumentasi.index', ['event' => $event, 'dokumentasi' => $dokumentasi]);
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
        $data = $request->all();
        $data['event_id'] = $event_id; 

        if($request->tipe == 'Slideshare'){
            $this->validate($request, [
                'nama_file' => 'required',
                'dokumentasi' => 'required',
            ]);
            
            // $nama_file = $request->nama_file;
            // $dokumentasi = $request->dokumentasi;
            // $total = count($nama_file);
        } else {
            $this->validate($request, [
                'dokumentasi' => 'required|array',
                'dokumentasi.*' => 'mimes:jpg,jpeg,png,ppt,pptx,pdf',
            ]);
        }

        if ($request->tipe == 'Slideshare'){
            // for($i=0;$i<$total;$i++){
                // Dokumentasi::create([
                //     'event_id' => $event_id,
                //     'nama_file' => $nama_file[$i],
                //     'tipe' => $request->tipe,
                //     'dokumentasi' => $dokumentasi[$i],
                // ]);
            // }
            Dokumentasi::create([
                'event_id' => $event_id,
                'nama_file' => $request->nama_file,
                'tipe' => $request->tipe,
                'dokumentasi' => $request->dokumentasi,
            ]);
        } else {
            foreach ($request->file('dokumentasi') as $file) {
                //get filename with extension
                $filenamewithextension = $file->getClientOriginalName();
            
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        
                //get file extension
                $extension = $file->getClientOriginalExtension();
        
                //filename to store
                $filenametostore = $filename.'_'.time().'.'.$extension;

                $data['dokumentasi'] = $file->storeAs('dokumentasi', $filenametostore, 'public');
                $data['nama_file'] = $filenamewithextension;
                $data['tipe'] = $extension;
                $data['event_id'] = $event_id;
                
                Dokumentasi::create($data);
            }
        }

        return redirect('/admin/data-event/'.$event_id.'/dokumentasi')->with('status', 'Dokumentasi Berhasil diupload');
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
    public function edit($event_id, $id)
    {
        $event = Event::findOrfail($event_id);
        $dokumentasi = Dokumentasi::findOrFail($id);
        return view('admin_dashboard.admin.data-event.dokumentasi.edit', ['event' => $event, 'dokumentasi' => $dokumentasi]);
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
        if($request->tipe == 'Slideshare'){
            $this->validate($request, [
                'nama_file' => 'required',
                'dokumentasi' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'dokumentasi' => 'required|array',
                'dokumentasi.*' => 'mimes:jpg,jpeg,png,ppt,pptx,pdf',
            ]);
        }
        
        $dokumentasi = Dokumentasi::findOrFail($id);
        
        $data = $request->all();

        if ($request->file('dokumentasi')) {
            Storage::disk('public')->delete($dokumentasi['dokumentasi']);

            //get filename with extension
            $filenamewithextension = $request->file('dokumentasi')->getClientOriginalName();
        
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('dokumentasi')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $data['dokumentasi'] = $request->file('dokumentasi')->storeAs('dokumentasi', $filenametostore, 'public');
            $data['nama_file'] = $filenamewithextension;
            $data['tipe'] = $extension;
        }
        $dokumentasi->update($data);

        return redirect()->route('data-event.dokumentasi.index', $event_id)->with('status', 'Dokumentasi Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id, $id)
    {
        $data = Dokumentasi::findOrFail($id);
        
        Storage::disk('public')->delete($data['dokumentasi']);

        $data->delete();

        return response()->json(array('success' => true));
    }
}
