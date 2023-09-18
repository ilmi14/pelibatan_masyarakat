<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadJawabanTugas extends Model
{
    use HasFactory;

    protected $table = "upload_jawaban_tugas";

    protected $fillable = [
        "jawaban_tugas_id", 
        "jawaban_tugas",
    ];

    public function jawabanTugas(){
        return $this->belongsTo(JawabanTugas::class);
    }
}
