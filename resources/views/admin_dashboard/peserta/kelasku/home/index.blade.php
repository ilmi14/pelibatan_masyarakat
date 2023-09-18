@extends('admin_dashboard.layouts.main')
@section('title')
    Kelasku | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.peserta.kelasku.includes.navbar')

    @if ($kelas->status == "Selesai")
        @if ($registrasi->sertifikat == "Terbit")
            <div class="card bg-success mb-3">
                <div class="card-body">
                    <p class="text-white">Selamat kamu telah dinyatakan <strong>lulus</strong> di {{ $kelas->nama_kelas }}!</p>
                    <a href="{{ url('peserta/kelasku/'.$kelas->id.'/sertifikat') }}" class="btn btn-info" title="Lihat Sertifikat">Lihat Sertifikat</a>
                </div>
            </div>
        @elseif ($registrasi->sertifikat == "Tidak Terbit")
            <div class="card bg-danger mb-3">
                <div class="card-body">
                    <p class="text-white">Mohon maaf anda dinyatakan <strong>tidak lulus</strong> di {{ $kelas->nama_kelas }}. dikarenakan belum memenuhi syarat dan ketentuan</p>
                    <p class="text-white">Berikut ini alasan kami tidak meluluskan anda: <br> {{ $registrasi->catatan_sertifikat }}</p>
                </div>
            </div>
        @else
            <div class="card mb-3">
                <div class="card-body bg-warning">
                    <p class="text-white"><strong>Mohon menunggu.</strong> Saat ini admin sedang memutuskan kelulusan anda di {{ $kelas->nama_kelas }}!</p>
                </div>
            </div>
        @endif
    @endif

    {{-- @if ($kelas->status == "Pendaftaran") --}}
        @if ($registrasi->status == "Diterima" && $kelas->status == "Pendaftaran")
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                <strong>Selamat!</strong> anda dinyatakan diterima di kelas {{ $kelas->nama_kelas }}. 
                @if ($registrasi->catatan!=null)
                    <br>
                    <strong>Catatan:</strong>
                    {{ $registrasi->catatan }}
                @endif
            </div>
        @elseif ($registrasi->status == "Ditolak")
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                <strong>Mohon Maaf</strong> anda belum lulus seleksi {{ $kelas->nama_kelas }}. silahkan coba lagi lain waktu.
                @if ($registrasi->catatan!=null)
                    <br>
                    <strong>Catatan:</strong>
                    {{ $registrasi->catatan }}
                @endif
            </div>
        @elseif ($registrasi->status == null && $kelas->status == "Pendaftaran")
            <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                <strong>Mohon menunggu</strong> saat ini masih proses seleksi peserta.
            </div>
        @endif
    {{-- @endif --}}
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-sm-4">
                @if ($kelas->banner != null)            
                    <img src="{{ Storage::url($kelas->banner) }}" height="300px" width="400px" style="object-fit: cover" class="" alt="widget-card-2">
                @else
                    <img src="{{ asset('admin_dashboard/assets/img/400x300.jpg') }}" class="img-fluid" alt="widget-card-2">
                @endif
            </div>
            <div class="col-sm-8">
                <div class="card-body">
                    <h2 class="card-title">{{ $kelas->nama_kelas }}</h2>
                    @if ($kelas->status == "Pendaftaran")
                        <div class="mb-2">
                            <p>Masa Pendaftaran : <br>{{ \Carbon\Carbon::parse($kelas->pendaftaran_buka)->format('j F Y')}} sampai {{ \Carbon\Carbon::parse($kelas->pendaftaran_tutup)->format('j F Y')}}</p>
                        </div>
                    @endif
                    <p class="tanggal" style="color: blue; font-weight: bold">{{ \Carbon\Carbon::parse($kelas->tanggal_mulai)->format('j F Y') }} - {{ \Carbon\Carbon::parse($kelas->tanggal_berakhir)->format('j F Y') }}</p>
                    @php
                        if($kelas->kelasKategori->TK_PAUD == 1){
                            $sasaran[] = "TK/PAUD";
                        }
                        if($kelas->kelasKategori->SD_MI == 1){
                            $sasaran[] = "SD/MI";
                        }
                        if($kelas->kelasKategori->SMP_MTS == 1){
                            $sasaran[] = "SMP/MTS";
                        }
                        if($kelas->kelasKategori->SMA_SMK_MA == 1){
                            $sasaran[] = "SMA/SMK/MA";
                        }
                        if($kelas->kelasKategori->Mahasiswa == 1){
                            $sasaran[] = "Mahasiswa";
                        }
                        if($kelas->kelasKategori->Masyarakat_Umum == 1){
                            $sasaran[] = "Masyarakat Umum";
                        }
                        if($kelas->kelasKategori->ASN_Polri_TNI == 1){
                            $sasaran[] = "ASN/Polri/TNI";
                        }
                    @endphp
                    <p class="card-text"> 
                        <small class="text-muted">
                            Sasaran : 
                            @foreach ($sasaran as $item)
                                @if($loop->last)
                                    {{ $item }}
                                @else
                                    {{ $item }},
                                @endif
                            @endforeach
                        </small>
                    </p>
                    @if($kelas->status == 'Pendaftaran')
                        <p class="card-text">Status : <span class="badge badge-success">{{ $kelas->status }}</span></p>
                    @elseif($kelas->status == 'Kegiatan Berlangsung')
                        <p class="card-text">Status : <span class="badge badge-primary">{{ $kelas->status }}</span></p>
                    @else
                        <p class="card-text">Status : <span class="badge badge-dark">{{ $kelas->status }}</span></p>                        
                    @endif
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <div class="widget-content widget-content-area">
        <h3>Persyaratan</h3>
        {!! $kelas->persyaratan !!}
        <br>
        <h3>Deskripsi</h3>
        {!! $kelas->deskripsi !!}   
    </div>
@endsection

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link href="{{ asset('admin_dashboard/assets/css/components/cards/card.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    
@endpush