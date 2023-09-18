<?php

namespace Database\Seeders;

use App\Models\KelasKategori;
use Illuminate\Database\Seeder;

class KelasKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KelasKategori::truncate();
        $categoryClass = ([
            [
                'kelas_id' => '1',
                'TK_PAUD' => '0',
                'SD_MI' => '0',
                'SMP_MTS' => '1',
                'SMA_SMK_MA' => '1',
                'Mahasiswa' => '1',
                'Masyarakat_Umum' => '1',
                'ASN_Polri_TNI' => '1',
            ],
            [
                'kelas_id' => '2',
                'TK_PAUD' => '1',
                'SD_MI' => '1',
                'SMP_MTS' => '1',
                'SMA_SMK_MA' => '0',
                'Mahasiswa' => '0',
                'Masyarakat_Umum' => '0',
                'ASN_Polri_TNI' => '0',
            ],
            [
                'kelas_id' => '3',
                'TK_PAUD' => '0',
                'SD_MI' => '0',
                'SMP_MTS' => '0',
                'SMA_SMK_MA' => '1',
                'Mahasiswa' => '1',
                'Masyarakat_Umum' => '1',
                'ASN_Polri_TNI' => '1',
            ],
            [
                'kelas_id' => '4',
                'TK_PAUD' => '0',
                'SD_MI' => '0',
                'SMP_MTS' => '1',
                'SMA_SMK_MA' => '1',
                'Mahasiswa' => '1',
                'Masyarakat_Umum' => '1',
                'ASN_Polri_TNI' => '1',
            ],
            [
                'kelas_id' => '5',
                'TK_PAUD' => '0',
                'SD_MI' => '0',
                'SMP_MTS' => '0',
                'SMA_SMK_MA' => '1',
                'Mahasiswa' => '1',
                'Masyarakat_Umum' => '1',
                'ASN_Polri_TNI' => '1',
            ],
            [
                'kelas_id' => '6',
                'TK_PAUD' => '0',
                'SD_MI' => '1',
                'SMP_MTS' => '1',
                'SMA_SMK_MA' => '1',
                'Mahasiswa' => '1',
                'Masyarakat_Umum' => '1',
                'ASN_Polri_TNI' => '1',
            ],
            // [
            //     'kelas_id' => '7',
            //     'TK_PAUD' => '0',
            //     'SD_MI' => '1',
            //     'SMP_MTS' => '1',
            //     'SMA_SMK_MA' => '0',
            //     'Mahasiswa' => '0',
            //     'Masyarakat_Umum' => '0',
            //     'ASN_Polri_TNI' => '0',
            // ],
        ]);
        foreach($categoryClass as $kategori){
            KelasKategori::create($kategori);
        }
    }
}
