<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPresensiEvent extends Model
{
    use HasFactory;

    protected $table = "data_presensi_event";

    protected $fillable = [
        "presensi_event_id", 
        "user_id",
        "status",
        "gambar",
    ];
    
    public function presensi(){
        return $this->belongsTo(PresensiEvent::class, 'presensi_event_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
