<?php

namespace App\Http\Controllers\admin_dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\KelasKategori;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kelas::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" class="cb-child" name="id[]" value='.$row->id.'>';
                    })
                    ->editColumn('periode_kelas', function($row){
                        return Carbon::parse($row->tanggal_mulai)->format('j F Y') . ' - ' . Carbon::parse($row->tanggal_berakhir)->format('j F Y');
                    })
                    ->editColumn('tutor_id', function($row){
                        return $row->tutor->nama;
                    })
                    ->editColumn('status', function($row){
                        if($row->status == 'Pendaftaran'){
                            $status = '<span class="badge badge-success">Pendaftaran</span>';
                        } elseif($row->status == 'Kegiatan Berlangsung'){
                            $status = '<span class="badge badge-primary">Kegiatan Berlangsung</span>';
                        } else {
                            $status = '<span class="badge badge-dark">Selesai</span>';
                        }
                        return '<td class="text-center">'. $status .'</td>';
                        // return '
                        // <td class="text-center">
                        //     <a href="'. route("kelas.status", $row) .'" class="d-flex justify-content-center">
                        //         '. $status .'
                        //     </a>
                        // </td>
                        // ';
                    })
                    ->addColumn('aksi', function($row){
                        return '
                            <td class="text-center">
                                <a href="'. route('kelas.edit', $row->id) .'" class="btn btn-sm btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" id="konfirmasiHapus'.$row->id.'" onclick="confirmDelete(this)" data-id="'.$row->id.'" title="Hapus"><i class="far fa-trash-alt"></i></button>
                            </td>
                        ';
                    })
                    ->rawColumns(['aksi', 'status', 'checkbox'])
                    ->make(true);
        }
        $tutor = User::all()->where('level', '=', 'tutor');
        return view('admin_dashboard.admin.kelas.index', ['tutor' => $tutor]);
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
            'tanggal_pendaftaran' => 'required',
            'nama_kelas' => 'required',
            'periode_kelas' => 'required',
            'persyaratan' => 'required',
            'deskripsi' => 'required',
            'tutor_id' => 'required',
            'status' => 'required',
        ]);
        
        $data = $request->all();
        
        if ($request->file('banner')){
            //get filename with extension
            $filenamewithextension = $request->file('banner')->getClientOriginalName();
        
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('banner')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $data['banner'] = $request->file('banner')->storeAs('kelas_banner', $filenametostore, 'public');
        }
        
        $dates = explode('to', $request->periode_kelas);
        $startDate = trim($dates[0]);
        $endDate = trim($dates[1]);
        $data['tanggal_mulai'] = $startDate;
        $data['tanggal_berakhir'] = $endDate;
        
        $datesPendaftaran = explode('to', $request->tanggal_pendaftaran);
        $startDatePendaftaran = trim($datesPendaftaran[0]);
        $endDatePendaftaran = trim($datesPendaftaran[1]);
        $data['pendaftaran_buka'] = $startDatePendaftaran;
        $data['pendaftaran_tutup'] = $endDatePendaftaran;
        
        $data['nama_kelas'] = $request->nama_kelas . ' ' . Carbon::parse($startDate)->format('Y');

        $kelas = Kelas::create($data);
       
        $data['kelas_id'] = $kelas->id;
        KelasKategori::create($data);

        return redirect()->route('kelas.index')->with('status', 'Kelas Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $kelas = Kelas::with('kelasKategori')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tutor = User::all()->where('level', '=', 'tutor');
        $kelas = Kelas::findOrFail($id);
        return view('admin_dashboard.admin.kelas.edit', ['kelas' => $kelas, 'tutor' => $tutor]);
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
            'nama_kelas' => 'required',
            'tanggal_pendaftaran' => 'required',
            'periode_kelas' => 'required',
            'tutor_id' => 'required',
            'status' => 'required',
        ]);
        
        $data = $request->all();

        $dates = explode('to', $request->periode_kelas);
        $startDate = trim($dates[0]);
        $endDate = trim($dates[1]);
        $data['tanggal_mulai'] = $startDate;
        $data['tanggal_berakhir'] = $endDate;

        $datesPendaftaran = explode('to', $request->tanggal_pendaftaran);
        $startDatePendaftaran = trim($datesPendaftaran[0]);
        $endDatePendaftaran = trim($datesPendaftaran[1]);
        $data['pendaftaran_buka'] = $startDatePendaftaran;
        $data['pendaftaran_tutup'] = $endDatePendaftaran;

        $data['nama_kelas'] = $request->nama_kelas . ' ' . Carbon::parse($startDate)->format('Y');

        $kelas = Kelas::findOrFail($id);
        if ($request->file('banner')){
            Storage::disk('public')->delete($kelas['banner']);
            //get filename with extension
            $filenamewithextension = $request->file('banner')->getClientOriginalName();
        
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('banner')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $data['banner'] = $request->file('banner')->storeAs('kelas_banner', $filenametostore, 'public');
        }
        $kelas->update($data);

        $kelasKategori = KelasKategori::where('kelas_id', '=', $id);
        $kelasKategori->update([
            'TK_PAUD' => $request->has('TK_PAUD'),
            'SD_MI' => $request->has('SD_MI'),
            'SMP_MTS' => $request->has('SMP_MTS'),
            'SMA_SMK_MA' => $request->has('SMA_SMK_MA'),
            'Mahasiswa' => $request->has('Mahasiswa'),
            'Masyarakat_Umum' => $request->has('Masyarakat_Umum'),
            'ASN_Polri_TNI' => $request->has('ASN_Polri_TNI'),
        ]);

        return redirect()->route('kelas.index')->with('status', 'Kelas berhasil di Perbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::with('kelasKategori')->findOrFail($id);
        
        $kelas->kelasKategori->delete();
        
        Storage::disk('public')->delete($kelas->banner);
        $kelas->delete();
        
        return response()->json(array('success' => true));
    }

    // public function status($id){
    //     $data = Kelas::findOrFail($id);
        
    //     ($data->status == 'Aktif') ? $status = "Tidak Aktif" : $status = "Aktif" ;
        
    //     $data->update([
    //         'status' => $status
    //     ]);

    //     return back()->with('status','Status berhasil diganti');
    // }

    public function status(Request $request){
        $this->validate($request, [
            "status"   => ["required", Rule::in(['Pendaftaran', 'Kegiatan Berlangsung', 'Selesai'])],
        ]);

        $kelas = Kelas::whereIn('id',$request->ids)->update(['status' => $request->status]);
        if($kelas){
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('success' => false));
        }
    }
}
