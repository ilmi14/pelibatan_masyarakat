<?php

namespace Database\Seeders;

use App\Models\RegistrasiKelas;
use Illuminate\Database\Seeder;

class RegistrasiKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RegistrasiKelas::truncate();
        $daftar = ([
            [
                'user_id' => 9,
                'kelas_id' => 3,
                'motivasi' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quia quas, saepe quidem voluptates natus eum ex vel facilis maiores ea fugit autem reprehenderit necessitatibus, asperiores maxime obcaecati laudantium quasi.',
                'status' => "Diterima",
            ],
        ]);
        foreach($daftar as $registrasi){
            RegistrasiKelas::create($registrasi);
        }
    }
}
