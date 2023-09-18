<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Silabus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ public_path().'/admin_dashboard/bootstrap/css/bootstrap.min.css' }}" rel="stylesheet" type="text/css" />
    <style>
        html {
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Silabus</h1>
    <table class="table table-sm table-borderless">
        <tbody>
            <tr>
                <th style="width: 9%">Nama Kelas</th>
                <td style="width: 1%">:</td>
                <td>{{ $kelas->nama_kelas }}</td>
            </tr>
            <tr>
                <th>Tutor</th>
                <td>:</td>
                <td>{{ $kelas->tutor->nama }}</td>
            </tr>
            <tr>
                <th>Periode</th>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($kelas->tanggal_mulai)->format('Y') }}</td>
            </tr>
        </tbody>
    </table>
    
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th class="text-center" style="width: 5%">No.</th>
                <th class="text-center">Materi</th>
                {{-- <th>Sasaran</th>
                <th>Metode</th> --}}
                <th class="text-center">Pokok Pembahasan</th>
                <th class="text-center">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($silabusBab as $key => $bab)
            @php
                $key += 1;
            @endphp
                <tr>
                    <td class="text-center">{{ $key }}</td>
                    <td>{{ $bab->nama_bab }}</td>
                    <td>
                        <ul>
                            @forelse ($bab->subbab as $subbab)
                                <li>{{ $subbab->nama_subbab }}</li>
                            @empty
                                
                            @endforelse
                        </ul>
                    </td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($bab->tanggal)->format('j F Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>