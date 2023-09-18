<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = "quiz";

    protected $fillable = ['kelas_id', 'nama_quiz', 'tanggal_quiz', 'waktu_pengerjaan', 'aktif'];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function quizSoal(){
        return $this->hasMany(QuizSoal::class);
    }

    public function quizJawaban(){
        return $this->hasMany(QuizJawaban::class);
    }

    public function quizNilai(){
        return $this->hasMany(NilaiQuiz::class);
    }
}
