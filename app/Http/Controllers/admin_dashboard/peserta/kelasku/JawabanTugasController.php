<?php

namespace App\Http\Controllers\admin_dashboard\peserta\kelasku;

use App\Http\Controllers\Controller;
use App\Models\JawabanTugas;
use App\Models\UploadJawabanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JawabanTugasController extends Controller
{
    public function store(Request $request, $kelas_id, $tugas_id){
        // $this->validate($request, [
        //     'jawaban' => 'required',
        // ]);

        $data = $request->all();
        $data['tugas_id'] = $tugas_id;
        $data['users_id'] = Auth::user()->id;
        $data['status'] = "Terkirim";
        $jawabanTugas = JawabanTugas::create($data);

        if ($request->file('jawaban_tugas')){
            foreach ($request->file('jawaban_tugas') as $file) {
                //get filename with extension
                $filenamewithextension = $file->getClientOriginalName();
            
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        
                //get file extension
                $extension = $file->getClientOriginalExtension();
        
                //filename to store
                $filenametostore = $filename.'_'.time().'.'.$extension;

                $data['jawaban_tugas'] = $file->storeAs('jawaban_tugas', $filenametostore, 'public');
                
                $data['jawaban_tugas_id'] = $jawabanTugas->id;
                UploadJawabanTugas::create($data);
            }
        }

        return redirect()->route('peserta.kelasku.tugas.show', [$kelas_id, $tugas_id])->with('status', 'Tugas Berhasil dikirim');
    }

    public function update(Request $request, $kelas_id, $id){
        $this->validate($request, [
            'nama_tugas' => 'required',
            'deskripsi' => 'required',
            'batas_waktu' => 'required',
        ]);

        $tugas = Tugas::with('uploadTugas')->findOrFail($id);
        
        $data = $request->all();

        if ($request->file('tugas')) {
            foreach ($tugas->uploadTugas as $item) {
                Storage::disk('public')->delete($item->tugas);
                $item->delete();
            }

            foreach ($request->file('tugas') as $file) {
                //get filename with extension
                $filenamewithextension = $file->getClientOriginalName();
            
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        
                //get file extension
                $extension = $file->getClientOriginalExtension();
        
                //filename to store
                $filenametostore = $filename.'_'.time().'.'.$extension;

                $data['tugas'] = $file->storeAs('tugas', $filenametostore, 'public');
                
                $data['tugas_id'] = $tugas->id;
                UploadTugas::create($data);
            }
        }

        $tugas->update($data);

        return redirect()->route('tutor.kelasku.tugas.index', $kelas_id)->with('status', 'Tugas Berhasil Diperbarui');
    }
}
