<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanTugas extends Model
{
    use HasFactory;

    protected $table = "jawaban_tugas";

    protected $fillable = [
        "tugas_id", 
        "users_id",
        "jawaban",
        "nilai",
        "catatan",
        "status",
    ];

    public function tugas(){
        return $this->belongsTo(Tugas::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function uploadJawabanTugas(){
        return $this->hasMany(UploadJawabanTugas::class);
    }
}
