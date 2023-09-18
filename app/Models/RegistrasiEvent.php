<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrasiEvent extends Model
{
    use HasFactory;

    protected $table = "registrasi_event";

    protected $fillable = [
        "user_id", 
        "event_id",
        "sertifikat",
        "catatan_sertifikat",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function event(){
        return $this->belongsTo(event::class);
    }
}
