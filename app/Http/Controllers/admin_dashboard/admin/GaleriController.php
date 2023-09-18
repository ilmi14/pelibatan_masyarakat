<?php

namespace App\Http\Controllers\admin_dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Galeri::orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('aksi', function($row){
                        return '
                            <td class="text-center">
                                <a href="'. route('galeri.edit', $row->id) .'" class="btn btn-sm btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" id="konfirmasiHapus'.$row->id.'" onclick="confirmDelete(this)" data-id="'.$row->id.'" title="Hapus"><i class="far fa-trash-alt"></i></button>
                            </td>
                        ';
                    })
                    ->addColumn('gambar', function($row){
                        return '<img src="'.Storage::url($row->photo_path).'" width="360px" alt="">';
                    })
                    ->editColumn('publish', function($row){
                        if($row->publish == 'Ya'){
                            $status = '<span class="badge badge-success">Ya</span>';
                        } else {
                            $status = '<span class="badge badge-danger">Tidak</span>';
                        }
                        return $status;
                    })
                    ->rawColumns(['aksi', 'publish', 'gambar'])
                    ->make(true);
        }
        return view('admin_dashboard.admin.galeri.index');
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
            'photo_path' => 'required|image|max:10240',
            'nama_foto' => 'required',
            'publish' => 'required',
        ]);
        
        $data = $request->all();

        if ($request->file('photo_path')){
            //get filename with extension
            $filenamewithextension = $request->file('photo_path')->getClientOriginalName();
        
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('photo_path')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $data['photo_path'] = $request->file('photo_path')->storeAs('galeri', $filenametostore, 'public');
        }

        Galeri::create($data);

        return redirect()->route('galeri.index')->with('status', 'Galeri Berhasil Ditambahkan');
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
        $galeri = Galeri::findOrFail($id);
        return view('admin_dashboard.admin.galeri.edit', ['galeri' => $galeri]);
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
        if ($request->photo_path) {
            $this->validate($request, [
                'photo_path' => 'required|image|max:10240',
                'nama_foto' => 'required',
                'publish' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'nama_foto' => 'required',
                'publish' => 'required',
            ]);
        }

        $data = $request->all();
        
        $galeri = Galeri::findOrFail($id);

        if ($request->file('photo_path')){
            Storage::disk('public')->delete($galeri['photo_path']);
            //get filename with extension
            $filenamewithextension = $request->file('photo_path')->getClientOriginalName();
        
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('photo_path')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $data['photo_path'] = $request->file('photo_path')->storeAs('galeri', $filenametostore, 'public');
        }

        $galeri->update($data);

        return redirect()->route('galeri.index')->with('status', 'Galeri berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        Storage::disk('public')->delete($galeri['photo_path']);
        
        $galeri->delete();

        return response()->json(array('success' => true));
    }
}
