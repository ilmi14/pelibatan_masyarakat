<?php

namespace App\Http\Controllers\admin_dashboard\admin\data_kelas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Silabus;
use App\Models\SilabusBab;
use Illuminate\Http\Request;

class SilabusKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kelas_id)
    {
        $kelas = Kelas::findOrfail($kelas_id);
        $silabus = Silabus::all();
        $bab = SilabusBab::where('silabus_id', $kelas->silabus_id)->get();
        
        return view('admin_dashboard.admin.data-kelas.silabus.index', ['kelas' => $kelas, 'silabus' => $silabus, 'bab' => $bab]);
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

    public function pilihSilabus(Request $request, $kelas_id){
        $this->validate($request, [
            'silabus_id' => 'required',
        ]);

        $data = $request->all();
        $silabus = Kelas::where('id', $kelas_id)->first();
        $silabus->update($data);

        return redirect()->route('data-kelas.silabus.index', $kelas_id)->with('status', 'Silabus berhasil dipasangkan');
    }
}
