<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = "tugas";

    protected $fillable = [
        "kelas_id", 
        "nama_tugas",
        "deskripsi",
        "batas_waktu",
    ];
    
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function uploadTugas(){
        return $this->hasMany(UploadTugas::class);
    }

    public function jawabanTugas(){
        return $this->hasMany(JawabanTugas::class);
    }
}
