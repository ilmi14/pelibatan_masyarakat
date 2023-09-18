<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quiz::truncate();
        $quizzes = ([
            [
                'kelas_id' => 3,
                'nama_quiz' => 'Quiz 1',
                'tanggal_quiz' => Carbon::now()->addDays(7),
                'waktu_pengerjaan' => 26,
                'aktif' => 'Y',
            ],
        ]);
        foreach($quizzes as $quiz){
            Quiz::create($quiz);
        }
    }
}
