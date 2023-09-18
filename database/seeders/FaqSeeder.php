<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::truncate();
        $faqs = ([
            [
                'pertanyaan' => 'Berapa lama waktu belajar di kelas pelibatan masyarakat?',
                'jawaban' => '5 Bulan terhitung sejak 28 Juni 2022 s.d. 31 Oktober 2022',
            ],
            [
                'pertanyaan' => 'Apakah kegiatan ini gratis?',
                'jawaban' => 'Kegiatan ini Gratis tidak dipungut biaya sepeserpun!',
            ],
            [
                'pertanyaan' => 'Berapa banyak pertemuan dalam seminggu?',
                'jawaban' => 'Masing-masing kelas. Dalam seminggu 1 kali pertemuan dengan durasi waktu 2 jam.',
            ],
            [
                'pertanyaan' => 'Batas pendaftaran sampai kapan?',
                'jawaban' => 'Batas pendaftaran sampai hari Rabu, 22 Juni 2022 Pukul 11.00 WIB.',
            ],
            [
                'pertanyaan' => 'Kapan pengumuman peserta kelas pelibatan masyarakat?',
                'jawaban' => 'Minggu, 26 Juni 2022',
            ],
            [
                'pertanyaan' => 'Apakah peserta yang sudah mendaftar sudah pasti bisa mengikuti kegiatan ini?',
                'jawaban' => 'Karena, banyaknya animo masyarakat namun keterbatasan sarana dan prasarana. Maka, akan ada penyaringan atau seleksi administrasi (Registrasi Online) yang keputusannya ditentukan oleh tutor setiap kelas.',
            ],
            [
                'pertanyaan' => 'Apakah semua peserta yang mengikuti kelas pasti akan mendapatkan sertifikat?',
                'jawaban' => 'Peserta berhak mendapatkan sertifikat bila memenuhi syarat aktif hadir mengikuti kegiatan dan syarat lain yang ditentukan oleh masing-masing tutor.',
            ],
            [
                'pertanyaan' => 'Apa kriteria kelas tari topeng?',
                'jawaban' => 'Peserta kelas tari topeng dikhususkan kepada pelajar PAUD/TK/SD/SMP.',
            ],
            [
                'pertanyaan' => 'Apa kriteria kelas menulis?',
                'jawaban' => 'Peserta kelas menulis dikhususkan kepada pelajar SMA/Mahasiswa dan Masyarakat Umum.',
            ],
            [
                'pertanyaan' => 'Apa kriteria kelas TIK?',
                'jawaban' => 'Peserta kelas TIK dikhususkan kepada pelajar SMP/SMA/Mahasiswa dan Masyarakat Umum.',
            ],
            [
                'pertanyaan' => 'Apa kriteria kelas Bahasa Inggris untuk Anak?',
                'jawaban' => 'Peserta kelas Bahasa Inggris untuk Anak dikhususkan kepada pelajar SD dan SMP.',
            ],
            [
                'pertanyaan' => 'Apa kriteria kelas Bahasa Inggris untuk Dewasa?',
                'jawaban' => 'Peserta kelas Bahasa Inggris untuk Dewasa dikhususkan kepada pelajar SMA, Mahasiswa dan Masyarakat Umum.',
            ],
            [
                'pertanyaan' => 'Apa kriteria kelas Bahasa Jepang?',
                'jawaban' => 'Peserta kelas Bahasa Jepang dikhususkan kepada pelajar SMP, SMA, Mahasiswa dan Masyarakat Umum.',
            ],
            [
                'pertanyaan' => 'Apa kriteria kelas Basic Programming?',
                'jawaban' => 'Peserta kelas Basic Programming dikhususkan kepada pelajar SMA, Mahasiswa dan Masyarakat Umum.',
            ],
            [
                'pertanyaan' => 'Apakah peserta kelas Basic Programming dan TIK harus membawa komputer/laptop pribadi?',
                'jawaban' => 'Kami menyediakan 10 unit komputer. Bagi peserta yang memiliki laptop pribadi disarankan untuk membawa sendiri saat mengikuti kegiatan ini.',
            ],
            [
                'pertanyaan' => 'Perlengkapan apa yang dibutuhkan untuk tari topeng?',
                'jawaban' => 'Peserta diwajibkan membawa slendang masing-masing.',
            ],
            [
                'pertanyaan' => 'Bolehkah orang tua mendampingi saat di kelas?',
                'jawaban' => 'Tidak boleh, orang tua dapat menunggu di ruang baca anak.',
            ],
            [
                'pertanyaan' => 'Apakah ada syarat lain-lain?',
                'jawaban' => 'Peserta wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.',
            ],
        ]);
        foreach($faqs as $faq){
            Faq::create($faq);
        }
    }
}
