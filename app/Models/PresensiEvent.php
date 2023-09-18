<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiEvent extends Model
{
    use HasFactory;

    protected $table = "presensi_event";

    protected $fillable = [
        "event_id", 
        "tanggal_mulai",
        "tanggal_berakhir",
        "foto",
    ];
    
    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function dataPresensi(){
        return $this->hasMany(DataPresensiEvent::class);
    }
}
