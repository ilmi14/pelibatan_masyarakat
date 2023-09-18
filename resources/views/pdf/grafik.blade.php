<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafik</title>
    <link href="{{ public_path().'/admin_dashboard/bootstrap/css/bootstrap.min.css' }}" rel="stylesheet" type="text/css" />
    <style>
        table{
            width: 100%
        }
        .border table, .border th, .border td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        body {  
            font-family: 'Helvetica'  
        }
    </style>
</head>
<body>
    <table class="table table-borderless bg-primary text-white">
        <tbody>
            <tr>
                <td>
                    <strong>Nama Kelas:</strong><br>
                    @if ($kelas != null)
                        {{ $kelas }}
                    @else
                        Semua
                    @endif
                </td>
                <td>
                    <strong>Periode:</strong><br>
                    @if ($kelas != null)
                        {{ $tahun }}
                    @else
                        {{ \Carbon\Carbon::now()->format('Y') }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Total Peserta Pendaftar Kelas:</strong><br>
                    {{ $pendaftar }}
                </td>
                <td>
                    <strong>Total Peserta Diterima:</strong><br>
                    {{ $pendaftar_diterima }}
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    @php
        $anak_anak = 0;
        $remaja = 0;
        $dewasa = 0;
        $manula = 0;

        $hari_ini = \Carbon\Carbon::now();
        foreach($peserta as $registrasiPeserta){
            if ($registrasiPeserta->user) {
                $tanggal_lahir = \Carbon\Carbon::parse($registrasiPeserta->user->tanggal_lahir);
                $umur = $tanggal_lahir->diffInYears($hari_ini); 
    
                if($umur>=5 && $umur<=11){
                    $anak_anak+=1;
                } elseif($umur>=12 && $umur<=19){
                    $remaja+=1;
                } elseif($umur>=20 && $umur<=49){
                    $dewasa+=1;
                } elseif($umur>=50){
                    $manula+=1;
                }
            }
        }

        $tk_paud = 0;
        $sd_mi = 0;
        $smp_mts = 0;
        $sma_smk_ma = 0;
        $mahasiswa = 0;
        $masyarakat_umum = 0;
        $asn_polri_tni = 0;
        foreach($peserta as $registrasiPeserta){
            if ($registrasiPeserta->user) {
                if($registrasiPeserta->user->tipe_anggota == 'TK/PAUD'){
                    $tk_paud+=1;
                } elseif($registrasiPeserta->user->tipe_anggota == 'SD/MI'){
                    $sd_mi+=1;
                } elseif($registrasiPeserta->user->tipe_anggota == 'SMP/MTS'){
                    $smp_mts+=1;
                } elseif($registrasiPeserta->user->tipe_anggota == 'SMA/SMK/MA'){
                    $sma_smk_ma+=1;
                } elseif($registrasiPeserta->user->tipe_anggota == 'Mahasiswa'){
                    $mahasiswa+=1;
                } elseif($registrasiPeserta->user->tipe_anggota == 'Masyarakat Umum'){
                    $masyarakat_umum+=1;
                } elseif($registrasiPeserta->user->tipe_anggota == 'ASN/Polri/TNI'){
                    $asn_polri_tni+=1;
                }
            }
        }

        $laki_laki = 0;
        $perempuan = 0;
        foreach($peserta as $registrasiPeserta){
            if ($registrasiPeserta->user) {
                if($registrasiPeserta->user->jenis_kelamin == 'Laki-laki'){
                    $laki_laki+=1;
                } elseif($registrasiPeserta->user->jenis_kelamin == 'Perempuan'){
                    $perempuan+=1;
                }
            }
        }
    @endphp
    <h5>1. Usia Peserta</h5>
    <p class="text-justify">Usia peserta dikategorikan terdiri dari 4 Jenis yaitu anak-anak yang berumur 5 sampai 11 tahun, remaja yang berumur 12 sampai 19 tahun, dewasa yang berumur 20 sampai 49 tahun, dan manula yang berumur diatas 50 tahun. untuk data selengkapnya bisa dilihat pada tabel berikut.</p>
    <table class="border">
        <tr class="text-center">
            <th>Usia</th>
            <th style="width: 25%">Jumlah Peserta</th>
        </tr>
        <tr>
            <td>Anak-anak (5 s.d. 11 Tahun)</td>
            <td class="text-center">{{ $anak_anak }}</td>
        </tr>
        <tr>
            <td>Remaja (12 s.d. 19 Tahun)</td>
            <td class="text-center">{{ $remaja }}</td>
        </tr>
        <tr>
            <td>Dewasa (20 s.d. 49 Tahun)</td>
            <td class="text-center">{{ $dewasa }}</td>
        </tr>
        <tr>
            <td>Manula (>50 Tahun)</td>
            <td class="text-center">{{ $manula }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <th class="text-center">{{ $anak_anak+$remaja+$dewasa+$manula }}</th>
        </tr>
    </table>
    <p class="mt-3">Berikut ini tampilan dalam bentuk grafik:</p>
    <div class="card mb-3">
        <div class="card-header">Usia Peserta</div>
        <div class="card-body text-center d-flex justify-content-center">
            <img src="{{ $usia }}" style="width: 100%" alt="">
        </div>
    </div>
    <div style="page-break-before: always;"></div>
    <h5>2. Tipe anggota Peserta</h5>
    <p class="text-justify">Tipe anggota peserta dikategorikan terdiri dari 7 Jenis yaitu TK/PAUD, SD/MI, SMP/MTS, SMA/SMK/MA, Mahasiswa, Masyarakat Umum dan ASN/POLRI/TNI. untuk data selengkapnya bisa dilihat pada tabel berikut.</p>
    <table class="border">
        <tr class="text-center">
            <th>Tipe Anggota</th>
            <th style="width: 25%">Jumlah Peserta</th>
        </tr>
        <tr>
            <td>TK/PAUD</td>
            <td class="text-center">{{ $tk_paud }}</td>
        </tr>
        <tr>
            <td>SD/MI</td>
            <td class="text-center">{{ $sd_mi }}</td>
        </tr>
        <tr>
            <td>SMP/MTS</td>
            <td class="text-center">{{ $smp_mts }}</td>
        </tr>
        <tr>
            <td>SMA/SMK/MA</td>
            <td class="text-center">{{ $sma_smk_ma }}</td>
        </tr>
        <tr>
            <td>Mahasiswa</td>
            <td class="text-center">{{ $mahasiswa }}</td>
        </tr>
        <tr>
            <td>Masyarakat Umum</td>
            <td class="text-center">{{ $masyarakat_umum }}</td>
        </tr>
        <tr>
            <td>ASN/POLRI/TNI</td>
            <td class="text-center">{{ $asn_polri_tni }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <th class="text-center">{{ $tk_paud+$sd_mi+$smp_mts+$sma_smk_ma+$mahasiswa+$masyarakat_umum+$asn_polri_tni }}</th>
        </tr>
    </table>
    <p class="mt-3">Berikut ini tampilan dalam bentuk grafik:</p>
    <div class="card mb-3">
        <div class="card-header">Tipe Anggota Peserta</div>
        <div class="card-body text-center d-flex justify-content-center">
            <img src="{{ $tipe_anggota }}" style="width: 100%" alt="">
        </div>
    </div>
    <div style="page-break-before: always;"></div>
    <h5>3. Jenis Kelamin Peserta</h5>
    <p class="text-justify">Jenis kelamin Peserta terdiri dari laki-laki dan perempuan. untuk data selengkapnya bisa dilihat pada tabel berikut.</p>
    <table class="border">
        <tr class="text-center">
            <th>Jenis Kelamin</th>
            <th style="width: 25%">Jumlah Peserta</th>
        </tr>
        <tr>
            <td>Laki-laki</td>
            <td class="text-center">{{ $laki_laki }}</td>
        </tr>
        <tr>
            <td>Perempuan</td>
            <td class="text-center">{{ $perempuan }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <th class="text-center">{{ $laki_laki+$perempuan }}</th>
        </tr>
    </table>
    <p class="mt-3">Berikut ini tampilan dalam bentuk grafik:</p>
    <div class="card">
        <div class="card-header">Jenis Kelamin Peserta</div>
        <div class="card-body text-center d-flex justify-content-center">
            <img src="{{ $jenis_kelamin }}" style="width: 100%" alt="">
        </div>
    </div>

<script type="text/javascript" src="{{ public_path().'/admin_dashboard/assets/js/libs/jquery-3.1.1.js' }}"></script>
<script type="text/javascript" src="{{ public_path().'/admin_dashboard/bootstrap/js/popper.min.js' }}"></script>
<script type="text/javascript" src="{{ public_path().'/admin_dashboard/bootstrap/js/bootstrap.min.js' }}"></script>
</body>
</html>