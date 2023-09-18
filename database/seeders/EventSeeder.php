<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        event::truncate();
        $events = ([
            [
                'banner' => '',
                'nama_event' => 'Bahasa Pemrograman JavaScript',
                'kategori' => 'Workshop',
                'Pembuat_event' => 'DPA Kabupaten Indramayu x Himatif Polindra',
                'tanggal_mulai' => Carbon::now()->addDays(7),
                'tanggal_berakhir' => Carbon::now()->addDays(10),
                'deskripsi' => '
                <p>JavaScript merupakan salah satu bahasa pemrograman yang populer saat ini. Pasalnya, Semenjak adanya Node.js, JavaScript dapat digunakan untuk mengembangkan aplikasi di banyak platform. Bahasa JavaScript terus berkembang dan memiliki komunitas yang luas. Sehingga bahasa ini sangat layak untuk kamu pelajari.</p>
                <p>Pada event kali ini, kamu akan berkenalan mulai dari:</p>
                <ul>
                    <li>Mengenal Bahasa Pemrograman JavaSript</li>
                    <li>Karakteristik dan Penggunaan JavaScript</li>
                    <li>Memasang Node.js</li>
                    <li>Menjalankan Program JavaScript Pertamamu.</li>
                </ul>
                ',
                'lokasi' => 'Perpustakaan Kabupaten Indramayu',
                'deadline_pendaftaran' => Carbon::now()->addDays(6),
                'kuota' => '30',
            ],
            [
                'banner' => '',
                'nama_event' => 'Tips Sukses Berkarir sebagai Developer dan Programmer 2022',
                'kategori' => 'Seminar',
                'Pembuat_event' => 'DPA Kabupaten Indramayu x Dicoding',
                'tanggal_mulai' => Carbon::now()->addDays(14),
                'tanggal_berakhir' => Carbon::now()->addDays(17),
                'deskripsi' => '
                <p>Tetap kembangkan skill mu di era pandemi. Jadikan hari-harimu lebih produktif dengan asah pengetahuan dan skill di Dicoding Event. Kali ini Dicoding LIVE disponsori oleh IDCamp dengan tema "Tips Sukses Berkarir sebagai Developer dan Programmer 2022"</p>
                <p>Developer dan programmer kini menjadi salah satu pekerjaan yang paling diminati. Jadi, tidak heran jika banyak orang yang tertarik mencoba profesi ini untuk berkarir. Sayangnya masih banyak orang berpikir bahwa bekerja menjadi developer dan programmer hanya berhubungan dengan hal-hal yang bersifat technical, padahal tidak. Banyak hal yang harus dipersiapkan dan diketahui saat ingin mulai berkarier di dunia kerja seperti tools apa yang bisa membantu produktivitas, cara berkomunikasi dengan tim, sampai problem solving masalah dalam tim. Kali ini bersama dengan Andri Suranta Ginting (Mobile Engineer, Gojek) akan kita bahas tips dari pengalaman beliau dalam berkarir sebagai developer dan programmer juga menyiapkan hal technical dan non-technical untuk dikuasai di dunia kerja.</p>
                ',
                'lokasi' => 'Online. gmeet: https://meet.google.com/abc-defg-hij',
                'deadline_pendaftaran' => Carbon::now()->addDays(13),
                'kuota' => '100',
            ],        
        ]);
        foreach($events as $event){
            Event::create($event);
        }
    }
}
