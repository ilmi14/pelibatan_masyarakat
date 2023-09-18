<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrasiKelas extends Model
{
    use HasFactory;

    protected $table = "registrasi_kelas";

    protected $fillable = [
        "user_id", 
        "kelas_id", 
        "motivasi",
        "status",
        "catatan",
        "sertifikat",
        "catatan_sertifikat",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}
