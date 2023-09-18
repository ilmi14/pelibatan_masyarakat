<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizJawaban extends Model
{
    use HasFactory;

    protected $table = 'quiz_jawaban';

    protected $fillable = [
        'user_id', 'quiz_id', 'quiz_soal_id', 'jawaban'
    ];

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function quizSoal(){
        return $this->belongsTo(QuizSoal::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
