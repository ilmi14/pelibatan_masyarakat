<?php

namespace App\Http\Controllers\admin_dashboard\tutor\silabus;

use App\Http\Controllers\Controller;
use App\Models\SilabusBab;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SilabusBabController extends Controller
{
    public function index(Request $request, $silabus_id)
    {
        $silabusBab = SilabusBab::where('silabus_id', '=', $silabus_id)->get();
        if ($request->ajax()) {
            return DataTables::of($silabusBab)
                    ->addIndexColumn()
                    ->addColumn('subbab', function($row){
                        return '
                            <a href="'.route('tutor.silabus.bab.subbab.index', [$row->silabus_id, $row->id]).'" class="btn btn-sm btn-primary" title="kelola soal"><i class="far fa-list-alt"></i></a>
                        ';
                    })
                    ->addColumn('aksi', function($row){
                        return '
                            <td class="text-center">
                                <a href="'.route('tutor.silabus.bab.edit', [$row->silabus_id, $row->id]).'" class="btn btn-sm btn-warning" title="edit"><i class="far fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" id="konfirmasiHapus'.$row->id.'" onclick="confirmDelete(this)" data-id="'.$row->id.'" title="Hapus"><i class="far fa-trash-alt"></i></button>
                            </td>
                        ';
                    })
                    ->rawColumns(['subbab', 'aksi'])
                    ->make(true);
        }
        return view('admin_dashboard.tutor.silabus.bab.index', ['silabus_id' => $silabus_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($silabus_id)
    {
        return view('admin_dashboard.tutor.silabus.bab.create', ['silabus_id' => $silabus_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $silabus_id)
    {
        $this->validate($request, [
            "nama_bab"   => "required|array",
            "nama_bab.*" => "required|string",
            "tanggal"   => "required|array",
            "tanggal.*" => "required",
        ]);

        $tanggal = $request->tanggal;
        $nama_bab = $request->nama_bab;
        $total = count($nama_bab);

        for($i=0;$i<$total;$i++){
            SilabusBab::create([
                'silabus_id' => $silabus_id,
                'nama_bab' => $nama_bab[$i],
                'tanggal' => $tanggal[$i],
            ]);
        }
        
        return redirect()->route('tutor.silabus.bab.index',[$silabus_id])->with('status', 'Silabus Bab berhasil dibuat');
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
    public function edit($silabus_id, $id)
    {
        $silabusBab = SilabusBab::findOrFail($id);
        return view('admin_dashboard.tutor.silabus.bab.edit', ['silabus_id' => $silabus_id, 'silabusBab' => $silabusBab]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $silabus_id, $id)
    {
        $this->validate($request, [
            'nama_bab' => 'required',
        ]);
        
        $silabusBab = SilabusBab::findOrFail($id);
        $silabusBab->update([
            'nama_bab' => $request->nama_bab,
        ]);

        return redirect()->route('tutor.silabus.bab.index', [$silabus_id])->with('status', 'Silabus Bab berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($silabus_id, $id)
    {
        $data = SilabusBab::with('subbab')->findOrFail($id);
        
        if ($data->subbab->count() > 0) {
            foreach ($data->subbab as $item) {
                $item->delete();
            }
        }

        $data->delete();

        return response()->json(array('success' => true));
    }
}
