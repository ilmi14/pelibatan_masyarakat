<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(KelasKategoriSeeder::class);
        
        $this->call(EventSeeder::class);
        $this->call(QuizSeeder::class);
        $this->call(QuizSoalSeeder::class);
        $this->call(RegistrasiKelasSeeder::class);
    }
}
