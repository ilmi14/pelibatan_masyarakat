<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSoal extends Model
{
    use HasFactory;

    protected $table = "quiz_soal";

    protected $fillable = ['quiz_id', 'soal', 'a', 'b', 'c', 'd', 'kunci_jawaban', 'file', 'aktif', 'pembahasan', 'aktif'];

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function quizJawaban(){
        return $this->hasMany(QuizJawaban::class);
    }
}
