<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "event";

    protected $fillable = [
        "banner", 
        "nama_event", 
        "kategori",
        "pembuat_event",
        "tanggal_mulai",
        "tanggal_berakhir",
        "deskripsi",
        "lokasi",
        "deadline_pendaftaran",
        "kuota",
    ];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('nama_event', 'like', '%' . $search . '%')
            ->orWhere('deskripsi', 'like', '%' . $search . '%');
        });

        $query->when($filters['sort'] ?? false, function($query, $sort){
            if($sort == "Event Terbaru"){
                return $query->orderBy('id', 'desc');
            } elseif($sort == "Segera Berakhir"){
                return $query->orderBy('deadline_pendaftaran', 'asc');
            }
        });
    }

    public function registrasiEvent(){
        return $this->hasMany(RegistrasiEvent::class);
    }

    public function dokumentasi(){
        return $this->hasMany(Dokumentasi::class);
    }

    public function presensi(){
        return $this->hasMany(PresensiEvent::class);
    }
}
