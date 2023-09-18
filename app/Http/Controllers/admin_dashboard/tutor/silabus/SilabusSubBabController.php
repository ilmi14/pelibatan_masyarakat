<?php

namespace App\Http\Controllers\admin_dashboard\tutor\silabus;

use App\Http\Controllers\Controller;
use App\Models\SilabusSubbab;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SilabusSubBabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $silabus_id, $bab_id)
    {
        $silabusSubBab = SilabusSubbab::with('bab')->where('silabus_bab_id', '=', $bab_id)->get();
        if ($request->ajax()) {
            return DataTables::of($silabusSubBab)
                    ->addIndexColumn()
                    ->addColumn('aksi', function($row){
                        return '
                            <td class="text-center">
                                <a href="'.route('tutor.silabus.bab.subbab.edit', [$row->bab->silabus_id, $row->silabus_bab_id, $row->id]).'" class="btn btn-sm btn-warning" title="edit"><i class="far fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" id="konfirmasiHapus'.$row->id.'" onclick="confirmDelete(this)" data-id="'.$row->id.'" title="Hapus"><i class="far fa-trash-alt"></i></button>
                            </td>
                        ';
                    })
                    ->rawColumns(['aksi'])
                    ->make(true);
        }

        return view('admin_dashboard.tutor.silabus.bab.subbab.index', ['silabus_id' => $silabus_id, 'bab_id' => $bab_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($silabus_id, $bab_id)
    {
        return view('admin_dashboard.tutor.silabus.bab.subbab.create', ['silabus_id' => $silabus_id, 'bab_id' => $bab_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $silabus_id, $bab_id)
    {
        $this->validate($request, [
            "nama_subbab"   => "required|array",
            "nama_subbab.*" => "required|string",
        ]);

        $nama_subbab = $request->nama_subbab;
        $total = count($nama_subbab);

        for($i=0;$i<$total;$i++){
            SilabusSubbab::create([
                'silabus_bab_id' => $bab_id,
                'nama_subbab' => $nama_subbab[$i],
            ]);
        }
        
        return redirect()->route('tutor.silabus.bab.subbab.index',[$silabus_id, $bab_id])->with('status', 'Silabus Subbab berhasil dibuat');
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
    public function edit($silabus_id, $bab_id, $id)
    {
        $silabusSubbab = SilabusSubbab::where('silabus_bab_id', $bab_id)->findOrFail($id);
        return view('admin_dashboard.tutor.silabus.bab.subbab.edit', ['silabus_id' => $silabus_id, 'bab_id' => $bab_id, 'silabusSubbab' => $silabusSubbab]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $silabus_id, $bab_id, $id)
    {
        $this->validate($request, [
            'nama_subbab' => 'required',
        ]);
        
        $silabusSubbab = SilabusSubbab::findOrFail($id);
        $silabusSubbab->update([
            'nama_subbab' => $request->nama_subbab,
        ]);

        return redirect()->route('tutor.silabus.bab.subbab.index', [$silabus_id, $bab_id])->with('status', 'Silabus Subbab berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($silabus_id, $bab_id, $id)
    {
        $data = SilabusSubbab::findOrFail($id);

        $data->delete();

        return response()->json(array('success' => true));
    }
}
