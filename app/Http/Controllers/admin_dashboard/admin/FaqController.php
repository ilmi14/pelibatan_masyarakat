<?php

namespace App\Http\Controllers\admin_dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Faq::orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('aksi', function($row){
                        return '
                            <td class="text-center">
                                <a href="'. route('faq.edit', $row->id) .'" class="btn btn-sm btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" id="konfirmasiHapus'.$row->id.'" onclick="confirmDelete(this)" data-id="'.$row->id.'" title="Hapus"><i class="far fa-trash-alt"></i></button>
                            </td>
                        ';
                    })
                    ->editColumn('jawaban', function($row){
                        return strip_tags($row->jawaban);
                    })
                    ->editColumn('publish', function($row){
                        if($row->publish == 'Ya'){
                            $status = '<span class="badge badge-success">Ya</span>';
                        } else {
                            $status = '<span class="badge badge-danger">Tidak</span>';
                        }
                        return $status;
                    })
                    ->rawColumns(['aksi', 'jawaban', 'publish'])
                    ->make(true);
        }
        return view('admin_dashboard.admin.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.admin.faq.create');
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
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);
        
        $data = $request->all();

        Faq::create($data);

        return redirect()->route('faq.index')->with('status', 'Pertanyaan dan Jawaban Berhasil Ditambahkan');
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
        $faq = Faq::findOrFail($id);
        return view('admin_dashboard.admin.faq.edit', ['faq' => $faq]);
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
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);

        $data = $request->all();
        
        $faq = Faq::findOrFail($id);

        $faq->update($data);

        return redirect()->route('faq.index')->with('status', 'Pertanyaan dan atau Jawaban berhasil di Perbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        
        $faq->delete();

        return response()->json(array('success' => true));
    }
}
