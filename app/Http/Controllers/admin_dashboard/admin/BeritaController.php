<?php

namespace App\Http\Controllers\admin_dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Berita::orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('aksi', function($row){
                        return '
                            <td class="text-center">
                                <a href="'. route('berita.edit', $row->id) .'" class="btn btn-sm btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" id="konfirmasiHapus'.$row->id.'" onclick="confirmDelete(this)" data-id="'.$row->id.'" title="Hapus"><i class="far fa-trash-alt"></i></button>
                            </td>
                        ';
                    })
                    ->editColumn('isi', function($row){
                        return strip_tags(substr($row->isi, 0, 300)) . "...";
                    })
                    ->editColumn('publish', function($row){
                        if($row->publish == 'Ya'){
                            $status = '<span class="badge badge-success">Ya</span>';
                        } else {
                            $status = '<span class="badge badge-danger">Tidak</span>';
                        }
                        return $status;
                    })
                    ->rawColumns(['aksi', 'isi', 'publish'])
                    ->make(true);
        }
        return view('admin_dashboard.admin.berita.berita.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriBerita = KategoriBerita::all();
        return view('admin_dashboard.admin.berita.berita.create', ['kategoriBerita' => $kategoriBerita]);
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
            'banner' => 'required|image|max:10240',
            'judul' => 'required',
            'kategori_id' => 'required',
            'isi' => 'required',
            'publish' => 'required',
        ]);
        
        $data = $request->all();

        $data['slug'] = Str::slug($request->judul, '-');

        if ($request->file('banner')){
            //get filename with extension
            $filenamewithextension = $request->file('banner')->getClientOriginalName();
        
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('banner')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $data['banner'] = $request->file('banner')->storeAs('berita', $filenametostore, 'public');
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('status', 'Berita Berhasil Dibuat');
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
        $berita = Berita::findOrFail($id);
        $kategoriBerita = KategoriBerita::all();
        return view('admin_dashboard.admin.berita.berita.edit', ['berita' => $berita, 'kategoriBerita' => $kategoriBerita]);
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
        if ($request->banner) {
            $this->validate($request, [
                'banner' => 'required|image|max:10240',
                'kategori_id' => 'required',
                'judul' => 'required',
                'isi' => 'required',
                'publish' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'judul' => 'required',
                'isi' => 'required',
                'publish' => 'required',
            ]);
        }
        $data = $request->all();

        $data['slug'] = Str::slug($request->judul, '-');
        
        $berita = Berita::findOrFail($id);

        if ($request->file('banner')){
            Storage::disk('public')->delete($berita['banner']);
            //get filename with extension
            $filenamewithextension = $request->file('banner')->getClientOriginalName();
        
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('banner')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $data['banner'] = $request->file('banner')->storeAs('berita', $filenametostore, 'public');
        }

        $berita->update($data);

        return redirect()->route('berita.index')->with('status', 'Berita berhasil di Perbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        Storage::disk('public')->delete($berita['banner']);
        
        $berita->delete();

        return response()->json(array('success' => true));
    }
}
