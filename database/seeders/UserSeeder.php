<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $users = ([
            [
                'username' => 'admin',
                'password' => bcrypt('admin123'),
                'email' => 'admin@email.com',
                'level' => 'admin',
                'nama' => 'DPA Kabupaten Indramayu',
                // 'jenis_kelamin' => '',
                // 'tempat_lahir' => '',
                // 'tanggal_lahir' => '',
                // 'foto' => '',
                // 'nomor_telepon' => '08123456789',
                // 'provinsi' => '',
                // 'kabupaten_kota' => '',
                // 'kecamatan' => '',
                // 'desa_kelurahan' => '',
                // 'alamat' => '',
                // 'tipe_anggota' => '',
                'status' => 'Sudah Verifikasi',
                'remember_token' => Str::random(60),
            ],
            [
                'username' => 'mustofa',
                'password' => bcrypt('admin123'),
                'email' => 'mustofa@email.com',
                'level' => 'tutor',
                'nama' => 'Mustofa, S.Pd.',
                'status' => 'Sudah Verifikasi',
                'remember_token' => Str::random(60),
            ],
            [
                'username' => 'jeni',
                'password' => bcrypt('admin123'),
                'email' => 'jeni@email.com',
                'level' => 'tutor',
                'nama' => 'Jeni, S.Pd.',
                'status' => 'Sudah Verifikasi',
                'remember_token' => Str::random(60),
            ],
            [
                'username' => 'mitro',
                'password' => bcrypt('admin123'),
                'email' => 'mitro@email.com',
                'level' => 'tutor',
                'nama' => 'Sumitro Hadi Harto, S.T.',
                'status' => 'Sudah Verifikasi',
                'remember_token' => Str::random(60),
            ],
            [
                'username' => 'endar',
                'password' => bcrypt('admin123'),
                'email' => 'endar@email.com',
                'level' => 'tutor',
                'nama' => 'Endar, A.Md.Kom.',
                'status' => 'Sudah Verifikasi',
                'remember_token' => Str::random(60),
            ],
            [
                'username' => 'minanto',
                'password' => bcrypt('admin123'),
                'email' => 'minanto@email.com',
                'level' => 'tutor',
                'nama' => 'Minanto, S.Hum.',
                'status' => 'Sudah Verifikasi',
                'remember_token' => Str::random(60),
            ],
            [
                'username' => 'nizmah',
                'password' => bcrypt('admin123'),
                'email' => 'nizmah@email.com',
                'level' => 'tutor',
                'nama' => 'Nizmah Khaerunnisa, S.Pd.',
                'status' => 'Sudah Verifikasi',
                'remember_token' => Str::random(60),
            ],
            [
                'username' => 'johndoe',
                'password' => bcrypt('admin123'),
                'email' => 'johndoe@email.com',
                'level' => 'peserta',
                'nama' => 'John Doe',
                'status' => 'Belum Verifikasi',
                'remember_token' => Str::random(60),
            ],
            [
                'username' => 'janedoe',
                'password' => bcrypt('admin123'),
                'email' => 'janedoe@email.com',
                'level' => 'peserta',
                'nama' => 'Jane Doe',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => '192',
                'tanggal_lahir' => Carbon::parse('2001-03-20'),
                'foto' => '',
                'nomor_telepon' => '08123456789',
                'provinsi' => '12',
                'kabupaten_kota' => '172',
                'kecamatan' => '2389',
                'desa_kelurahan' => '29759',
                'alamat' => 'Suta Jaya',
                'tipe_anggota' => 'Mahasiswa',
                'status' => 'Sudah Verifikasi',
                'remember_token' => Str::random(60),
            ]
        ]);
        foreach($users as $user){
            User::create($user);
        }
    }
}
