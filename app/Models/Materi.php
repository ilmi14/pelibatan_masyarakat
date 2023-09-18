<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = "materi";

    protected $fillable = [
        "kelas_id", 
        "nama_materi",
        "deskripsi",
    ];
    
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function uploadMateri(){
        return $this->hasMany(UploadMateri::class);
    }
}
