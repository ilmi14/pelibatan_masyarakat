<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;

    protected $table = "dokumentasi";

    protected $fillable = [
        "event_id", 
        "nama_file",
        "tipe",
        "dokumentasi", 
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
