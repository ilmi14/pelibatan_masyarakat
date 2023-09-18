<?php

namespace Database\Seeders;

use App\Models\QuizSoal;
use Illuminate\Database\Seeder;

class QuizSoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuizSoal::truncate();
        $soal = ([
            [
                'quiz_id' => 1,
                'soal' => 'User atau Operator Komputer dalam Istilah Komputer disebut dengan..?',
                'a' => 'Brainware',
                'b' => 'Fireware',
                'c' => 'Software',
                'd' => 'Hardware',
                'kunci_jawaban' => 'A',
                'aktif' => 'Y',
            ],
            [
                'quiz_id' => 1,
                'soal' => 'CPU Merupakan Singkatan dari',
                'a' => 'Central Progamming Unit',
                'b' => 'Central Promoting Unit',
                'c' => 'Central Processing Unit',
                'd' => 'Central Producing Unit',
                'kunci_jawaban' => 'C',
                'aktif' => 'Y',
            ],
            [
                'quiz_id' => 1,
                'soal' => 'Jaringan dari elemen-elemen yang saling berhubungan adalah ?',
                'a' => 'pentium',
                'b' => 'instal',
                'c' => 'system',
                'd' => 'data',
                'kunci_jawaban' => 'C',
                'aktif' => 'Y',
            ],
            [
                'quiz_id' => 1,
                'soal' => 'Berikut merupakan elemen-elemen sistem komputer kecuali...?',
                'a' => 'Fireware',
                'b' => 'Brainware',
                'c' => 'Software',
                'd' => 'Hadware',
                'kunci_jawaban' => 'A',
                'aktif' => 'Y',
            ],
            [
                'quiz_id' => 1,
                'soal' => 'Program yang berisi perinta-perintah / perangkat lunak disebut...?',
                'a' => 'Pentium',
                'b' => 'Brainware',
                'c' => 'Hardware',
                'd' => 'software',
                'kunci_jawaban' => 'D',
                'aktif' => 'Y',
            ],
            [
                'quiz_id' => 1,
                'soal' => 'Proses memasukkan dan memasang software ke dalam komputer disebut...?',
                'a' => 'data',
                'b' => 'instal',
                'c' => 'loading',
                'd' => 'online',
                'kunci_jawaban' => 'B',
                'aktif' => 'Y',
            ],
            [
                'quiz_id' => 1,
                'soal' => 'Berikut yang bukan termasuk alat output adalah...?',
                'a' => 'keyboard',
                'b' => 'speaker',
                'c' => 'monitor',
                'd' => 'printer',
                'kunci_jawaban' => 'A',
                'aktif' => 'Y',
            ],
            [
                'quiz_id' => 1,
                'soal' => 'Tanda panah (tanda lain) yang mewakili posisi gerakan mouse disebut dengan...?',
                'a' => 'kursor',
                'b' => 'mouse',
                'c' => 'pointer',
                'd' => 'printer',
                'kunci_jawaban' => 'C',
                'aktif' => 'Y',
            ],
            [
                'quiz_id' => 1,
                'soal' => 'Fungsi printer adalah untuk....?',
                'a' => 'mengeluarkan suara',
                'b' => 'mencetak dokumen',
                'c' => 'menyimpan dokumen',
                'd' => 'salah semua',
                'kunci_jawaban' => 'B',
                'aktif' => 'Y',
            ],
            [
                'quiz_id' => 1,
                'soal' => 'USB merupakan singkatan dari',
                'a' => 'universal serial buss',
                'b' => 'unit serial bus',
                'c' => 'Universal Serial Bus',
                'd' => 'Unit serial booster',
                'kunci_jawaban' => 'C',
                'aktif' => 'Y',
            ],
            [
                'quiz_id' => 1,
                'soal' => 'Salah satu perangkat Lunak pengolah kata adalah',
                'a' => 'Ms.Word',
                'b' => 'Winamp',
                'c' => 'CC cleaner',
                'd' => 'Jet audio',
                'kunci_jawaban' => 'A',
                'aktif' => 'Y',
            ],
            [
                'quiz_id' => 1,
                'soal' => 'Program yang digunakan untuk disain gambar adalah..?',
                'a' => 'Ms.Exel',
                'b' => 'Media Player',
                'c' => 'Power Point',
                'd' => 'Photoshop',
                'kunci_jawaban' => 'D',
                'aktif' => 'Y',
            ],
            [
                'quiz_id' => 1,
                'soal' => 'Yang bukan termasuk Hadware / Perangkat Keras adalah..',
                'a' => 'CPU',
                'b' => 'Keyboard',
                'c' => 'Ms.Office',
                'd' => 'Printer',
                'kunci_jawaban' => 'C',
                'aktif' => 'Y',
            ],
        ]);
        foreach($soal as $soal){
            QuizSoal::create($soal);
        }
    }
}
