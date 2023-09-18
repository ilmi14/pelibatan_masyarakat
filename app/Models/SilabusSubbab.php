<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SilabusSubbab extends Model
{
    use HasFactory;

    protected $table = "silabus_subbab";

    protected $fillable = [
        "silabus_bab_id",
        "nama_subbab", 
    ];

    public function bab(){
        return $this->belongsTo(SilabusBab::class, 'silabus_bab_id');
    }
}
