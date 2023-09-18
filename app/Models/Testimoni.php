<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $table = "testimoni";

    protected $fillable = [
        "kelas_id", 
        "user_id", 
        "rating",
        "deskripsi",
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
