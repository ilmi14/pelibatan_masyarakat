<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presensi</title>
    {{-- <link href="{{ public_path().'/admin_dashboard/bootstrap/css/bootstrap.min.css' }}" rel="stylesheet" type="text/css" /> --}}
    <style>
        .img {
            position: absolute;
            left: 50px;
            margin-right: 5px
        }
        .kop {
            font-family: Arial, Helvetica, sans-serif;
            font-style: normal;
            margin: 1.5;

            color: #000000;
        }
        .body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-style: normal;
            margin: 1.5;

            color: #000000;
        }
        #pemda {
            position: relative;
            width: 500px;
            height: 18px;
            left: 220px;
            /* top: 0px; */


            font-weight: 400;
            font-size: 16px;
            line-height: 18px;
        }
        #dinas {
            position: relative;
            left: 215px;
            /* top: 20px; */

            font-weight: 700;
            font-size: 18px;
            line-height: 21px;
            /* identical to box height */
        }
        #alamat {
            position: relative;
            left: 169px;
            /* top: 50px; */

            width: 430px
            font-weight: 400;
            font-size: 11px;
            line-height: 13px;
            text-align: center;
        }
        hr {
            margin: 2;
        }
        hr.top {
            height: 0;
            border: 2;
        }
        .text-center {
            text-align: center;
        }
        table {
            width: 100%
        }
        table, td, th {
            border-collapse: collapse;
            border: none;
        }
        .bordered th, .bordered td{
            border: 1px solid;
            line-height: 35px;
        }
       .informasi{
            position: relative;
            left: 130px;
        }
    </style>
</head>
<body>

        <img class="img" src="{{ public_path().'/pdf-asset/indramayu.png' }}" width="65px" alt="">
        <h2 class="kop" id="pemda">PEMERINTAH KABUPATEN INDRAMAYU</h2>
        <h2 class="kop" id="dinas">DINAS PERPUSTAKAAN DAN ARSIP</h2>
        <p class="kop" id="alamat">
            Jalan MT. Haryono No. 49 Telp/Faximili. (0234) 277139 – Indramayu Kode Pos 45222, 
            e-mail : arpusindramayu@yahoo.co.id, Website :disarpus.indramayukab.go.id
        </p>

        <hr class="top" noshade>
        <hr noshade>

        <div class="body">
            <p class="text-center"><b>DAFTAR HADIR PESERTA KEGIATAN PELIBATAN MASYARAKAT</b></p>  
            <p class="text-center"><b>TAHUN ANGGARAN {{ \Carbon\Carbon::now()->format('Y') }}</b></p>

            <div class="informasi">
                <table class="table">
                    <tr>
                        <td style="width: 21%">Kegiatan</td>
                        <td style="width: 2%">:</td>
                        <td>{{ $kelas->nama_kelas }}</td>
                    </tr>
                    <tr>
                        <td>Tutor</td>
                        <td>:</td>
                        <td>{{ $kelas->tutor->nama }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($presensi->tanggal_mulai)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y') }}</td>
                    </tr>
                </table>
            </div>

            <table class="table bordered" style="margin-top: 25px">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Pekerjaan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataPresensi as $index => $data)
                    @php
                        $index += 1;
                    @endphp
                        <tr>
                            <td class="text-center">{{ $index }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ ucwords(strtolower(\Indonesia::findVillage($data->desa_kelurahan)->name)) }}</td>
                            <td>{{ $data->tipe_anggota }}</td>
                            @if($data->presensi_status != null)
                                <td class="text-center">{{ $data->presensi_status }}</td>
                            {{-- @elseif(\Carbon\Carbon::now() > $presensi->tanggal_berakhir && $data->presensi_status == null)
                                <td>Belum Mengisi</td> --}}
                            @else
                                <td class="text-center">Tidak Hadir</td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                    {{-- <tr>
                        <td class="text-center">1.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">2.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">3.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">4.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">5.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">6.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">7.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">8.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">9.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">10.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">11.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">12.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">13.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">14.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">15.</td>
                        <td>Fuad Hadisurya</td>
                        <td>Indramayu</td>
                        <td>Mahasiswa</td>
                        <td class="text-center">Hadir</td>
                    </tr> --}}
                </tbody>
            </table>

            <table class="table">
                <tbody>
                    <tr>
                        <td style="width: 50%"></td>
                        <td style="width: 50%" class="text-center">
                            <p>Petugas</p>
                            <br><br>
                            <p>(…………………………………………)</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

</body>
</html>