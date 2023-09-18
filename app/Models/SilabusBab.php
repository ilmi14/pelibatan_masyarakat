<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SilabusBab extends Model
{
    use HasFactory;

    protected $table = "silabus_bab";

    protected $fillable = [
        "kelas_id",
        "nama_bab", 
        "tanggal",
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function subbab(){
        return $this->hasMany(SilabusSubbab::class);
    }
}
