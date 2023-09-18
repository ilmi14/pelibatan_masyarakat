<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::truncate();
        // $class = ([
        //     [
        //         'banner' => '',
        //         'nama_kelas' => 'Kelas Bahasa Jepang ' . Carbon::now()->format('Y'),
        //         'pendaftaran_buka' => Carbon::parse('2022-06-20'),
        //         'pendaftaran_tutup' => Carbon::parse('2022-06-22'),
        //         'tanggal_mulai' => Carbon::parse('2022-06-28'),
        //         'tanggal_berakhir' => Carbon::parse('2022-10-31'),
        //         'persyaratan' => '
        //             <ul>
        //                 <li>Peserta kelas Bahasa Jepang dikhususkan kepada pelajar SMP/Sederajat, SMA/Sederajat, Mahasiswa dan Masyarakat Umum.</li>
        //                 <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
        //             </ul>
        //         ',
        //         'deskripsi' => '
        //             <p>Peserta akan belajar beberapa keterampilan Bahasa Jepang yaitu mendengarkan (Choukai), berbicara (Kaiwa), Membaca (Dokkai), Menulis (Sakubun), dan belajar tata bahasa (Bunpou) dasar, serta belajar huruf-huruf dalam bahasa jepang yaitu Hiragana, Katakana, dan kanji sesuai kaidah dan aturan penulisan huruf yang baik dan benar.</p>
        //             <p>Selain itu, peserta akan belajar tentang beberapa kebudayaan yang ada di jepang. Pembelajaran akan dikemas secara menarik dan asik untuk dipelajari oleh peserta.</p>
        //             <p>Kelas Bahasa Jepang ini, 20% belajar teori, 80% praktik. Diharapkan peserta setelah mnengikuti kelas ini dari bulan Juni sampai Oktober 2022, mampu berbicara dan menulis Bahasa Jepang dasar dalam kehidupan sehari-hari.</p>
        //             <p>Peserta yang mengikuti Kelas Bahasa Jepang ini dari pelajar SMP sampai lanjut usia. Jadi, tunggu apa lagi! yuk gabung di Kelas Bahasa Jepang Pelibatan Masyarakat di Perpustakaan Kabupaten Indramayu.</p>
        //         ',
        //         'tutor_id' => '2',
        //         'status' => 'Pendaftaran',
        //     ],
        //     [
        //         'banner' => '',
        //         'nama_kelas' => 'Kelas Tari Topeng ' . Carbon::now()->format('Y'),
        //         'pendaftaran_buka' => Carbon::parse('2022-06-20'),
        //         'pendaftaran_tutup' => Carbon::parse('2022-06-22'),
        //         'tanggal_mulai' => Carbon::parse('2022-06-28'),
        //         'tanggal_berakhir' => Carbon::parse('2022-10-31'),
        //         'persyaratan' => '
        //             <ul>
        //                 <li>Peserta kelas tari topeng dikhususkan kepada pelajar PAUD, TK, SD/Sederajat, dan SMP/Sederajat.</li>
        //                 <li>Peserta diwajibkan untuk membawa slendang masing-masing.</li>
        //                 <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
        //             </ul>
        //         ',
        //         'deskripsi' => '
        //             <p>Di Kelas Tari Topeng kita akan belajar tentang bagaimana gerak dari tari topeng itu sendiri khususnya Topeng Kelana, dan dikelas tari juga kita akan melatih kepercayaan diri untuk tampil didepan, dan bisa mengekspresikan diri melalui gerakan tari.</p>
        //             <p>Kita tidak hanya akan belajar tari topeng saja, tapi tari yang lainnya juga akan dipelajari.</p>
        //             <p>Sasaran untuk kelas tari yaitu pelajar TK, PAUD, SD dan SMP.</p>
        //         ',
        //         'tutor_id' => '3',
        //         'status' => 'Pendaftaran',
        //     ],
        //     [
        //         'banner' => '',
        //         'nama_kelas' => 'Kelas Basic Programming ' . Carbon::now()->format('Y'),
        //         'pendaftaran_buka' => Carbon::parse('2022-06-20'),
        //         'pendaftaran_tutup' => Carbon::parse('2022-06-22'),
        //         'tanggal_mulai' => Carbon::parse('2022-06-28'),
        //         'tanggal_berakhir' => Carbon::parse('2022-10-31'),
        //         'persyaratan' => '
        //             <ul>
        //                 <li>Peserta kelas Basic Programming dikhususkan untuk pelajar SMA/Sederajat, Mahasiswa, dan Masyarakat Umum.</li>
        //                 <li>Kami menyediakan 10 Unit komputer. Bagi peserta yang memiliki laptop pribadi disarankan untuk membawa sendiri.</li>
        //                 <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
        //             </ul>
        //         ',
        //         'deskripsi' => '
        //             <p>Di Kelas Basic Programming akan dibahas mengenai pemrograman web, yang akan dipelajari yaitu HTML, CSS, dan Javascript. Tiga elemen tersebut merupakan hal utama yang wajib dikuasai terlebih dahulu dan merupakan kunci utama dalam membangun sebuah web.</p>
        //             <p>Untuk mempratekkan ilmu yang didapat maka di kelas ini akan diberikkan studi kasus membuat website portofolio dan cara menyimpan file project ke layanan penyedia hosting.</p>
        //             <p>Sasaran kelas ini yaitu untuk pelajar SMA/SMK, Mahasiswa, dan Masyarakat Umum.</p>
        //             <p>Setelah mengikuti kelas ini peserta diharapkan dapat membuat website dan dapat mengembangkannya menjadi website/aplikasi yang dinamis.</p>
        //         ',
        //         'tutor_id' => '4',
        //         'status' => 'Pendaftaran',
        //     ],
        //     [
        //         'banner' => '',
        //         'nama_kelas' => 'Kelas TIK ' . Carbon::now()->format('Y'),
        //         'pendaftaran_buka' => Carbon::parse('2022-06-20'),
        //         'pendaftaran_tutup' => Carbon::parse('2022-06-22'),
        //         'tanggal_mulai' => Carbon::parse('2022-06-28'),
        //         'tanggal_berakhir' => Carbon::parse('2022-10-31'),
        //         'persyaratan' => '
        //             <ul>
        //                 <li>peserta kelas TIK dikhususkan kepada pelajar SMP/sederajat, SMA/Sederajat, Mahasiswa, dan Masyarakat Umum.</li>
        //                 <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
        //             </ul>
        //         ',
        //         'deskripsi' => '
        //             <p>Di Kelas TIK peserta akan dibekali materi tentang Microsoft Office seperti Microsoft Word, Microsoft Excel, dan Microsoft PowerPoint.</p>
        //             <p>Untuk mempraktekkan ilmu yang didapat maka dikelas ini akan diberikan praktik, tugas, diskusi, dan lain-lain.</p>
        //             <p>Sasaran kelas ini yaitu untuk pelajar SMP, SMA, Mahasiswa, dan Masyarakat Umum.</p>
        //             <p>Setelah mengikuti kelas ini peserta diharapkan dapat meningkatkan pemahaman terkait ilmu komputer dalam kehidupan sehari-hari.</p>
        //         ',
        //         'tutor_id' => '5',
        //         'status' => 'Pendaftaran',
        //     ],
        //     [
        //         'banner' => '',
        //         'nama_kelas' => 'Kelas Menulis ' . Carbon::now()->format('Y'),
        //         'pendaftaran_buka' => Carbon::parse('2022-06-20'),
        //         'pendaftaran_tutup' => Carbon::parse('2022-06-22'),
        //         'tanggal_mulai' => Carbon::parse('2022-06-28'),
        //         'tanggal_berakhir' => Carbon::parse('2022-10-31'),
        //         'persyaratan' => '
        //             <ul>
        //                 <li>Peserta kelas menulis dihususkan kepada pelajar SMA/Sederajat, Mahasiswa, dan Masyarakat Umum.</li>
        //                 <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
        //             </ul>
        //         ',
        //         'deskripsi' => '
        //             <p>Di Kelas Menulis, peserta akan belajar bagaimana unsur-unsur Bahasa Indonesia secara mendasar, bagaimana bagaimana memoles ide agar menjadi tulisan, bagaimana merangkai paragraf agar menjadi teks padu dengan memperhatikan kaidah penulisan yang baik dan benar.</p>
        //             <p>Setelah itu, kita juga akan mempelajari bentuk-bentuk tulisan secara umum; esai, artikel, teks ulasan dan narasi. Melalui pengenalan dan pembelajaran bentuk tulisan tersebut, para peserta diharapkan dapat merasa betah dengan salah satu--atau semua bentuk--dalam menuliskan idenya.</p>
        //             <p>Dan paling penting dari yang disebutkan di atas, adalah para peserta akan mendalami penulisan fiksi (naratif); mengetahui ide, membuat draft tulisan, mengetahui elemen-elemen pembentuk fiksi, dan mengedit tulisan sehingga tepat kaidah.</p>
        //         ',
        //         'tutor_id' => '6',
        //         'status' => 'Pendaftaran',
        //     ],
        //     [
        //         'banner' => '',
        //         'nama_kelas' => 'Kelas Bahasa Inggris untuk Dewasa ' . Carbon::now()->format('Y'),
        //         'pendaftaran_buka' => Carbon::parse('2022-06-20'),
        //         'pendaftaran_tutup' => Carbon::parse('2022-06-22'),
        //         'tanggal_mulai' => Carbon::parse('2022-06-28'),
        //         'tanggal_berakhir' => Carbon::parse('2022-10-31'),
        //         'persyaratan' => '
        //             <ul>
        //                 <li>Peserta Kelas Bahasa Inggris untuk Dewasa dikhususkan untuk pelajar SMA/Sederajat, Mahasiswa, dan Masyarakat Umum.</li>
        //                 <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
        //             </ul>
        //         ',
        //         'deskripsi' => '
        //             <p>Di Kelas Bahasa Inggris, peserta akan belajar empat keterampilan berbahasa yaitu mendengarkan, berbicara, membaca, menulis, plus belajar tata bahasa (grammar) mulai dari dasar.</p>
        //             <p>Kelas ini akan terbagi dalam dua kelompok, yaitu pelajar SD-SMP dan SMA-Umum.</p>
        //             <p>Untuk peserta SD-SMP, kita akan bersenang-senang di kelas. Selama lima bulan ke depan, kita akan belajar sambil bermain tapi tetap berfokus pada memperbanyak kosakata Bahasa Inggris</p>
        //             <p>Sementara untuk SMA-Umum, kita akan bersama melatih keberanian dan rasa percaya diri berbicara Bahasa Inggris di depan banyak orang dengan cara yang menyenangkan</p>
        //         ',
        //         'tutor_id' => '7',
        //         'status' => 'Pendaftaran',
        //     ],
        //     [
        //         'banner' => '',
        //         'nama_kelas' => 'Kelas Bahasa Inggris untuk Anak ' . Carbon::now()->format('Y'),
        //         'pendaftaran_buka' => Carbon::parse('2022-06-20'),
        //         'pendaftaran_tutup' => Carbon::parse('2022-06-22'),
        //         'tanggal_mulai' => Carbon::parse('2022-06-28'),
        //         'tanggal_berakhir' => Carbon::parse('2022-10-31'),
        //         'persyaratan' => '
        //             <ul>
        //             <li>Peserta Kelas Bahasa Inggris untuk Dewasa dikhususkan untuk pelajar SD/Sederajat, dan SMP/Sederajat.</li>
        //                 <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
        //             </ul>
        //         ',
        //         'deskripsi' => '
        //             <p>Di Kelas Bahasa Inggris, peserta akan belajar empat keterampilan berbahasa yaitu mendengarkan, berbicara, membaca, menulis, plus belajar tata bahasa (grammar) mulai dari dasar.</p>
        //             <p>Kelas ini akan terbagi dalam dua kelompok, yaitu pelajar SD-SMP dan SMA-Umum.</p>
        //             <p>Untuk peserta SD-SMP, kita akan bersenang-senang di kelas. Selama lima bulan ke depan, kita akan belajar sambil bermain tapi tetap berfokus pada memperbanyak kosakata Bahasa Inggris</p>
        //             <p>Sementara untuk SMA-Umum, kita akan bersama melatih keberanian dan rasa percaya diri berbicara Bahasa Inggris di depan banyak orang dengan cara yang menyenangkan</p>
        //         ',
        //         'tutor_id' => '7',
        //         'status' => 'Pendaftaran',
        //     ],
        // ]);
        
        $class = ([
            [
                'banner' => '',
                'nama_kelas' => 'Kelas Bahasa Jepang ' . Carbon::now()->format('Y'),
                'pendaftaran_buka' => Carbon::now(),
                'pendaftaran_tutup' => Carbon::now()->addDays(7),
                'tanggal_mulai' => Carbon::now()->addDays(14),
                'tanggal_berakhir' => Carbon::now()->addDays(164),
                'persyaratan' => '
                    <ul>
                        <li>Peserta kelas Bahasa Jepang dikhususkan kepada pelajar SMP/Sederajat, SMA/Sederajat, Mahasiswa dan Masyarakat Umum.</li>
                        <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
                    </ul>
                ',
                'deskripsi' => '
                    <p>Peserta akan belajar beberapa keterampilan Bahasa Jepang yaitu mendengarkan (Choukai), berbicara (Kaiwa), Membaca (Dokkai), Menulis (Sakubun), dan belajar tata bahasa (Bunpou) dasar, serta belajar huruf-huruf dalam bahasa jepang yaitu Hiragana, Katakana, dan kanji sesuai kaidah dan aturan penulisan huruf yang baik dan benar.</p>
                    <p>Selain itu, peserta akan belajar tentang beberapa kebudayaan yang ada di jepang. Pembelajaran akan dikemas secara menarik dan asik untuk dipelajari oleh peserta.</p>
                    <p>Kelas Bahasa Jepang ini, 20% belajar teori, 80% praktik. Diharapkan peserta setelah mnengikuti kelas ini dari bulan Juni sampai Oktober 2022, mampu berbicara dan menulis Bahasa Jepang dasar dalam kehidupan sehari-hari.</p>
                    <p>Peserta yang mengikuti Kelas Bahasa Jepang ini dari pelajar SMP sampai lanjut usia. Jadi, tunggu apa lagi! yuk gabung di Kelas Bahasa Jepang Pelibatan Masyarakat di Perpustakaan Kabupaten Indramayu.</p>
                ',
                'tutor_id' => '2',
                'status' => 'Pendaftaran',
            ],
            [
                'banner' => '',
                'nama_kelas' => 'Kelas Tari Topeng ' . Carbon::now()->format('Y'),
                'pendaftaran_buka' => Carbon::now(),
                'pendaftaran_tutup' => Carbon::now()->addDays(7),
                'tanggal_mulai' => Carbon::now()->addDays(14),
                'tanggal_berakhir' => Carbon::now()->addDays(164),
                'persyaratan' => '
                    <ul>
                        <li>Peserta kelas tari topeng dikhususkan kepada pelajar PAUD, TK, SD/Sederajat, dan SMP/Sederajat.</li>
                        <li>Peserta diwajibkan untuk membawa slendang masing-masing.</li>
                        <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
                    </ul>
                ',
                'deskripsi' => '
                    <p>Di Kelas Tari Topeng kita akan belajar tentang bagaimana gerak dari tari topeng itu sendiri khususnya Topeng Kelana, dan dikelas tari juga kita akan melatih kepercayaan diri untuk tampil didepan, dan bisa mengekspresikan diri melalui gerakan tari.</p>
                    <p>Kita tidak hanya akan belajar tari topeng saja, tapi tari yang lainnya juga akan dipelajari.</p>
                    <p>Sasaran untuk kelas tari yaitu pelajar TK, PAUD, SD dan SMP.</p>
                ',
                'tutor_id' => '3',
                'status' => 'Pendaftaran',
            ],
            [
                'banner' => '',
                'nama_kelas' => 'Kelas Basic Programming ' . Carbon::now()->format('Y'),
                'pendaftaran_buka' => Carbon::now(),
                'pendaftaran_tutup' => Carbon::now()->addDays(7),
                'tanggal_mulai' => Carbon::now()->addDays(14),
                'tanggal_berakhir' => Carbon::now()->addDays(164),
                'persyaratan' => '
                    <ul>
                        <li>Peserta kelas Basic Programming dikhususkan untuk pelajar SMA/Sederajat, Mahasiswa, dan Masyarakat Umum.</li>
                        <li>Kami menyediakan 10 Unit komputer. Bagi peserta yang memiliki laptop pribadi disarankan untuk membawa sendiri.</li>
                        <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
                    </ul>
                ',
                'deskripsi' => '
                    <p>Di Kelas Basic Programming akan dibahas mengenai pemrograman web, yang akan dipelajari yaitu HTML, CSS, dan Javascript. Tiga elemen tersebut merupakan hal utama yang wajib dikuasai terlebih dahulu dan merupakan kunci utama dalam membangun sebuah web.</p>
                    <p>Untuk mempratekkan ilmu yang didapat maka di kelas ini akan diberikkan studi kasus membuat website portofolio dan cara menyimpan file project ke layanan penyedia hosting.</p>
                    <p>Sasaran kelas ini yaitu untuk pelajar SMA/SMK, Mahasiswa, dan Masyarakat Umum.</p>
                    <p>Setelah mengikuti kelas ini peserta diharapkan dapat membuat website dan dapat mengembangkannya menjadi website/aplikasi yang dinamis.</p>
                ',
                'tutor_id' => '4',
                'status' => 'Pendaftaran',
            ],
            [
                'banner' => '',
                'nama_kelas' => 'Kelas TIK ' . Carbon::now()->format('Y'),
                'pendaftaran_buka' => Carbon::now(),
                'pendaftaran_tutup' => Carbon::now()->addDays(7),
                'tanggal_mulai' => Carbon::now()->addDays(14),
                'tanggal_berakhir' => Carbon::now()->addDays(164),
                'persyaratan' => '
                    <ul>
                        <li>peserta kelas TIK dikhususkan kepada pelajar SMP/sederajat, SMA/Sederajat, Mahasiswa, dan Masyarakat Umum.</li>
                        <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
                    </ul>
                ',
                'deskripsi' => '
                    <p>Di Kelas TIK peserta akan dibekali materi tentang Microsoft Office seperti Microsoft Word, Microsoft Excel, dan Microsoft PowerPoint.</p>
                    <p>Untuk mempraktekkan ilmu yang didapat maka dikelas ini akan diberikan praktik, tugas, diskusi, dan lain-lain.</p>
                    <p>Sasaran kelas ini yaitu untuk pelajar SMP, SMA, Mahasiswa, dan Masyarakat Umum.</p>
                    <p>Setelah mengikuti kelas ini peserta diharapkan dapat meningkatkan pemahaman terkait ilmu komputer dalam kehidupan sehari-hari.</p>
                ',
                'tutor_id' => '5',
                'status' => 'Pendaftaran',
            ],
            [
                'banner' => '',
                'nama_kelas' => 'Kelas Menulis ' . Carbon::now()->format('Y'),
                'pendaftaran_buka' => Carbon::now(),
                'pendaftaran_tutup' => Carbon::now()->addDays(7),
                'tanggal_mulai' => Carbon::now()->addDays(14),
                'tanggal_berakhir' => Carbon::now()->addDays(164),
                'persyaratan' => '
                    <ul>
                        <li>Peserta kelas menulis dihususkan kepada pelajar SMA/Sederajat, Mahasiswa, dan Masyarakat Umum.</li>
                        <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
                    </ul>
                ',
                'deskripsi' => '
                    <p>Di Kelas Menulis, peserta akan belajar bagaimana unsur-unsur Bahasa Indonesia secara mendasar, bagaimana bagaimana memoles ide agar menjadi tulisan, bagaimana merangkai paragraf agar menjadi teks padu dengan memperhatikan kaidah penulisan yang baik dan benar.</p>
                    <p>Setelah itu, kita juga akan mempelajari bentuk-bentuk tulisan secara umum; esai, artikel, teks ulasan dan narasi. Melalui pengenalan dan pembelajaran bentuk tulisan tersebut, para peserta diharapkan dapat merasa betah dengan salah satu--atau semua bentuk--dalam menuliskan idenya.</p>
                    <p>Dan paling penting dari yang disebutkan di atas, adalah para peserta akan mendalami penulisan fiksi (naratif); mengetahui ide, membuat draft tulisan, mengetahui elemen-elemen pembentuk fiksi, dan mengedit tulisan sehingga tepat kaidah.</p>
                ',
                'tutor_id' => '6',
                'status' => 'Pendaftaran',
            ],
            [
                'banner' => '',
                'nama_kelas' => 'Kelas Bahasa Inggris ' . Carbon::now()->format('Y'),
                'pendaftaran_buka' => Carbon::now(),
                'pendaftaran_tutup' => Carbon::now()->addDays(7),
                'tanggal_mulai' => Carbon::now()->addDays(14),
                'tanggal_berakhir' => Carbon::now()->addDays(164),
                'persyaratan' => '
                    <ul>
                        <li>Peserta Kelas Bahasa Inggris untuk Anak dikhususkan untuk pelajar SD/Sederajat, dan SMP/Sederajat.</li>
                        <li>Peserta Kelas Bahasa Inggris untuk Dewasa dikhususkan untuk pelajar SMA/Sederajat, Mahasiswa, dan Masyarakat Umum.</li>
                        <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
                    </ul>
                ',
                'deskripsi' => '
                    <p>Di Kelas Bahasa Inggris, peserta akan belajar empat keterampilan berbahasa yaitu mendengarkan, berbicara, membaca, menulis, plus belajar tata bahasa (grammar) mulai dari dasar.</p>
                    <p>Kelas ini akan terbagi dalam dua kelompok, yaitu pelajar SD-SMP dan SMA-Umum.</p>
                    <p>Untuk peserta SD-SMP, kita akan bersenang-senang di kelas. Selama lima bulan ke depan, kita akan belajar sambil bermain tapi tetap berfokus pada memperbanyak kosakata Bahasa Inggris</p>
                    <p>Sementara untuk SMA-Umum, kita akan bersama melatih keberanian dan rasa percaya diri berbicara Bahasa Inggris di depan banyak orang dengan cara yang menyenangkan</p>
                ',
                'tutor_id' => '7',
                'status' => 'Pendaftaran',
            ],
            // [
            //     'banner' => '',
            //     'nama_kelas' => 'Kelas Bahasa Inggris untuk Anak ' . Carbon::now()->format('Y'),
            //     'pendaftaran_buka' => Carbon::now(),
            //     'pendaftaran_tutup' => Carbon::now()->addDays(7),
            //     'tanggal_mulai' => Carbon::now()->addDays(14),
            //     'tanggal_berakhir' => Carbon::now()->addDays(164),
            //     'persyaratan' => '
            //         <ul>
            //             <li>Peserta Kelas Bahasa Inggris untuk Anak dikhususkan untuk pelajar SD/Sederajat, dan SMP/Sederajat.</li>
            //             <li>Peserta Wajib mematuhi protokol kesehatan, berpakaian rapih, sopan, menjaga kebersihan dan ketertiban di kelas serta dapat hadir tepat waktu.</li>
            //         </ul>
            //     ',
            //     'deskripsi' => '
            //         <p>Di Kelas Bahasa Inggris, peserta akan belajar empat keterampilan berbahasa yaitu mendengarkan, berbicara, membaca, menulis, plus belajar tata bahasa (grammar) mulai dari dasar.</p>
            //         <p>Kelas ini akan terbagi dalam dua kelompok, yaitu pelajar SD-SMP dan SMA-Umum.</p>
            //         <p>Untuk peserta SD-SMP, kita akan bersenang-senang di kelas. Selama lima bulan ke depan, kita akan belajar sambil bermain tapi tetap berfokus pada memperbanyak kosakata Bahasa Inggris</p>
            //         <p>Sementara untuk SMA-Umum, kita akan bersama melatih keberanian dan rasa percaya diri berbicara Bahasa Inggris di depan banyak orang dengan cara yang menyenangkan</p>
            //     ',
            //     'tutor_id' => '7',
            //     'status' => 'Pendaftaran',
            // ],
        ]);
        foreach($class as $kelas){
            Kelas::create($kelas);
        }
    }
}
