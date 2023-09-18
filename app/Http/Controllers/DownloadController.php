<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use App\Models\UploadJawabanTugas;
use App\Models\UploadMateri;
use App\Models\UploadTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function materi($kelas_id, $id){
        $uploadMateri = UploadMateri::findOrFail($id);
        return Storage::disk('public')->download($uploadMateri['materi']);
    }

    public function tugas($kelas_id, $id){
        $uploadTugas = UploadTugas::findOrFail($id);
        return Storage::disk('public')->download($uploadTugas['tugas']);
    }

    public function jawabanTugas($kelas_id, $id){
        $uploadJawabanTugas = UploadJawabanTugas::findOrFail($id);
        return Storage::disk('public')->download($uploadJawabanTugas['jawaban_tugas']);
    }

    public function dokumentasi($event_id, $id){
        $dokumentasi = Dokumentasi::findOrFail($id);
        return Storage::disk('public')->download($dokumentasi['dokumentasi']);
    }
}
