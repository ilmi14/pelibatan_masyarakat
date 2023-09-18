<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiQuiz extends Model
{
    use HasFactory;

    protected $table = "nilai_quiz";

    protected $fillable = [
        "quiz_id", 
        "user_id",
        "jawaban_benar",
        "jawaban_salah",
        "jawaban_kosong",
        "nilai",
    ];

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
