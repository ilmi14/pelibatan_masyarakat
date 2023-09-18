<?php

namespace App\Http\Controllers\admin_dashboard\tutor\silabus;

use App\Http\Controllers\Controller;
use App\Models\Silabus;
use App\Models\SilabusBab;
use App\Models\SilabusSubbab;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SilabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $silabus = Silabus::where('user_id', Auth::user()->id)->get();
        if ($request->ajax()) {
            return DataTables::of($silabus)
            ->addIndexColumn()
            ->addColumn('bab', function($row){
                return '
                    <td class="text-center">
                        <a href="'. route('tutor.silabus.bab.index', $row->id) .'" class="btn btn-sm btn-info" title="Lihat"><i class="far fa-list-alt"></i></a>
                    </td>
                ';
            })
            ->editColumn('created_at', function($row){
                return Carbon::parse($row->created_at)->format('Y');
            })
            ->addColumn('aksi', function($row){
                return '
                    <td class="text-center">
                        <a href="'. route('tutor.silabus.edit', $row->id) .'" class="btn btn-sm btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                        <button class="btn btn-sm btn-danger" id="konfirmasiHapus' . $row->id . '" onclick="confirmDelete(this)" data-id="' . $row->id . '" title="Hapus"><i class="far fa-trash-alt"></i></button>
                    </td>
                ';
            })
            ->rawColumns(['aksi', 'bab'])
            ->make(true);
        }
        return view('admin_dashboard.tutor.silabus.index', ['silabus' => $silabus]);
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
            'nama_silabus' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        Silabus::create($data);

        return redirect()->route('tutor.silabus.index')->with('status', 'Silabus Berhasil dibuat');
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
        $silabus = Silabus::where('user_id', Auth::user()->id)->findOrFail($id);
        return view('admin_dashboard.tutor.silabus.edit', ['silabus' => $silabus]);
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
            'nama_silabus' => 'required',
        ]);

        $data = $request->all();

        $silabus = Silabus::findOrFail($id);
        $silabus->update($data);

        return redirect()->route('tutor.silabus.index')->with('status', 'Silabus berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $silabus = Silabus::findOrFail($id);
        
        $silabusBab = SilabusBab::whereIn('silabus_id', [$id]);
        if($silabusBab->count() > 0){
            $silabusBabId = SilabusBab::whereIn('silabus_id', [$id])->get('id');
            $silabusSubBab = SilabusSubBab::whereIn('silabus_bab_id', $silabusBabId);
            if($silabusSubBab->count() > 0){
                $silabusSubBab->delete();
            }

            $silabusBab->delete();
        }
        
        $silabus->delete();
        
        return response()->json(array('success' => true));
    }
}
