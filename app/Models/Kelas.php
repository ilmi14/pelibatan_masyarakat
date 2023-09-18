<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "kelas";

    protected $fillable = [
        "tutor_id",
        // "silabus_id",
        "banner", 
        "nama_kelas",
        "pendaftaran_buka",
        "pendaftaran_tutup",
        "tanggal_mulai",
        "tanggal_berakhir",
        "persyaratan",
        "deskripsi",
        "status",
    ];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('nama_kelas', 'like', '%' . $search . '%');
        });

        $query->when($filters['sort'] ?? false, function($query, $sort){
            if($sort == "Terbaru"){
                return $query->orderBy('id', 'desc');
            } elseif($sort == "Terlama"){
                return $query->orderBy('id', 'asc');
            }
        });

        $query->when($filters['category'] ?? false, function($query, $category){
            return $query->whereHas('kelasKategori', function($query) use ($category){
                if($category == "TK/PAUD"){
                    return $query->where('TK_PAUD', 1);
                } elseif($category == "SD/MI"){
                    return $query->where('SD_MI', 1);
                } elseif($category == "SMP/MTS"){
                    return $query->where('SMP_MTS', 1);
                } elseif($category == "SMA/SMK/MA"){
                    return $query->where('SMA_SMK_MA', 1);
                } elseif($category == "Mahasiswa"){
                    return $query->where('Mahasiswa', 1);
                } elseif($category == "Masyarakat Umum"){
                    return $query->where('Masyarakat_Umum', 1);
                } elseif($category == "ASN/Polri/TNI"){
                    return $query->where('ASN_Polri_TNI', 1);
                }
            });
        });
    }

    public function tutor(){
        return $this->belongsTo(User::class);
    }

    public function silabus(){
        return $this->belongsTo(Silabus::class);
    }

    public function kelasKategori(){
        return $this->hasOne(KelasKategori::class);
    }

    public function quiz(){
        return $this->hasMany(Quiz::class);
    }

    public function registrasiKelas(){
        return $this->hasMany(RegistrasiKelas::class);
    }

    public function presensi(){
        return $this->hasMany(Presensi::class);
    }
}
