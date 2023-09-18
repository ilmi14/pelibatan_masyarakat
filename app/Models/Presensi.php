<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = "presensi";

    protected $fillable = [
        "kelas_id", 
        "tanggal_mulai",
        "tanggal_berakhir",
        "foto",
    ];
    
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function dataPresensi(){
        return $this->hasMany(DataPresensi::class);
    }
}
