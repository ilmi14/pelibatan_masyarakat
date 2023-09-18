@extends('admin_dashboard.layouts.main')
@section('title')
    Detail Kelas | Sibakat
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade layout-top-spacing">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="row layout-top-spacing">
        
        <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
            <div class="user-profile layout-spacing sticky-top" style="top: 105px;">
                <div class="card component-card_9">
                    @if($kelas->banner != null)
                        <img src="{{ Storage::url($kelas->banner) }}" class="card-img-top" width="400" height="300" style="object-fit: cover" alt="widget-card-2">
                    @else
                        <img src="{{ asset('admin_dashboard/assets/img/400x300.jpg') }}" class="card-img-top" alt="widget-card-2">
                    @endif
                    <div class="card-body">
                        <div>
                            @if (Carbon\Carbon::now()->format('Y-m-d') < $kelas->pendaftaran_buka)
                                <span class="badge badge-info mb-3">Segera Dibuka</span>
                            @elseif (Carbon\Carbon::now()->format('Y-m-d') > $kelas->pendaftaran_buka && Carbon\Carbon::now()->format('Y-m-d') < $kelas->pendaftaran_tutup)
                                <span class="badge badge-success mb-3">Pendaftaran Dibuka</span>
                            @elseif (Carbon\Carbon::now()->format('Y-m-d') > $kelas->pendaftaran_tutup)    
                                <span class="badge badge-danger mb-3">Pendaftaran Ditutup</span>
                            @endif
                        </div>
                        <p class="meta-date">{{ \Carbon\Carbon::parse($kelas->tanggal_mulai)->format('j F Y') }} - {{ \Carbon\Carbon::parse($kelas->tanggal_berakhir)->format('j F Y') }}</p>
                        <h5 class="nama-kelas">{{ $kelas->nama_kelas }}</h5>
                        <div class="mb-2">
                            <p>Masa Pendaftaran : <br>{{ \Carbon\Carbon::parse($kelas->pendaftaran_buka)->format('j F Y')}} sampai {{ \Carbon\Carbon::parse($kelas->pendaftaran_tutup)->format('j F Y')}}</p>
                            {{-- <div class="row">
                                <div class="col-sm-3">Mulai</div>
                                <div class="col-sm-9">: 
                                    <b>{{ \Carbon\Carbon::parse($kelas->pendaftaran_buka)->format('j F Y')}}</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Selesai</div>
                                <div class="col-sm-9">: 
                                    <b>{{ \Carbon\Carbon::parse($kelas->pendaftaran_tutup)->format('j F Y')}}</b>
                                </div>
                            </div> --}}
                        </div>
                        @php
                            if($kelas->kelasKategori->TK_PAUD == 1){
                                $sasaran['TK/PAUD'] = "TK/PAUD";
                            } else {
                                $sasaran['TK/PAUD'] = null;
                            }
                            if($kelas->kelasKategori->SD_MI == 1){
                                $sasaran['SD/MI'] = "SD/MI";
                            } else {
                                $sasaran['SD/MI'] = null;
                            }
                            if($kelas->kelasKategori->SMP_MTS == 1){
                                $sasaran["SMP/MTS"] = "SMP/MTS";
                            } else {
                                $sasaran['SMP/MTS'] = null;
                            }
                            if($kelas->kelasKategori->SMA_SMK_MA == 1){
                                $sasaran["SMA/SMK/MA"] = "SMA/SMK/MA";
                            } else {
                                $sasaran['SMA/SMK/MA'] = null;
                            }
                            if($kelas->kelasKategori->Mahasiswa == 1){
                                $sasaran["Mahasiswa"] = "Mahasiswa";
                            } else {
                                $sasaran['Mahasiswa'] = null;
                            }
                            if($kelas->kelasKategori->Masyarakat_Umum == 1){
                                $sasaran["Masyarakat Umum"] = "Masyarakat Umum";
                            } else {
                                $sasaran['Masyarakat Umum'] = null;
                            }
                            if($kelas->kelasKategori->ASN_Polri_TNI == 1){
                                $sasaran["ASN/Polri/TNI"] = "ASN/Polri/TNI";
                            } else {
                                $sasaran['ASN/TNI/POLRI'] = null;
                            }
                        @endphp
                        <p> 
                            Sasaran : 
                            @foreach ($sasaran as $item)
                                @if ($item != null)
                                    @if($loop->last)
                                        {{ $item }}
                                    @else
                                        {{ $item }},
                                    @endif
                                @endif
                            @endforeach
                        </p>
                        <hr>
                        <div class="meta-user">
                            <div class="avatar avatar-sm">
                                @if ($kelas->tutor->foto != null)
                                    <span class="avatar-title rounded-circle"><img alt="avatar" src="{{ Storage::url($kelas->tutor->foto) }}" width="30" height="30" style="object-fit: cover" class="rounded-circle" /></span>
                                @else
                                    <span class="avatar-title rounded-circle"><img alt="avatar" src="{{ asset('admin_dashboard/assets/img/90x90.jpg') }}" width="30" height="30" class="rounded-circle" /></span>
                                @endif
                            </div>
                            <div class="user-name">{{ $kelas->tutor->nama }}</div>
                        </div>
                        <hr>
                        @if(count($registrasi_kelas) > 0)
                            <button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" disabled>
                                Terimakasih sudah mendaftar
                            </button>
                        @elseif(Auth::user()->status == 'Belum Verifikasi')
                            <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" disabled>
                                Verifikasi akun terlebih dahulu
                            </button>
                        @elseif(Auth::user()->tipe_anggota != $sasaran[Auth::user()->tipe_anggota])
                            <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" disabled>
                                Tipe anggotamu adalah {{ Auth::user()->tipe_anggota }}. tidak bisa mengikuti kegiatan ini.
                            </button>
                        @else
                            @if (Carbon\Carbon::now()->format('Y-m-d') < $kelas->pendaftaran_buka)
                                <button type="button" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" disabled>
                                    Mohon menunggu. Pendaftaran dibuka tanggal  <strong>{{ \Carbon\Carbon::parse($kelas->pendaftaran_buka)->format('j F Y') }}</strong>
                                </button>
                            @elseif (Carbon\Carbon::now()->format('Y-m-d') >= $kelas->pendaftaran_buka && Carbon\Carbon::now()->format('Y-m-d') <= $kelas->pendaftaran_tutup)
                                <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">
                                    Daftar Sekarang
                                </button>
                            @elseif (Carbon\Carbon::now()->format('Y-m-d') > $kelas->pendaftaran_tutup)    
                                <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" disabled>
                                    Pendaftaran sudah ditutup
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">
            <div class="layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">Persyaratan</h3>
                    {!! $kelas->persyaratan !!}
                </div>
            </div>
            <div class="layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">Deskripsi</h3>
                    {!! $kelas->deskripsi !!}
                </div>                                
            </div>
        </div>

    </div>

@endsection

@push('modal')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('peserta.kelas.daftar', $kelas->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        @error('motivasi')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="alert alert-info" role="alert">
                            Silahkan Isi Motivasi berikut, apa alasan anda ingin mengikuti Kelas nama kelas? 
                            <strong>Isilah motivasi anda minimal 30 kata</strong>
                        </div>
                        <div class="form-group mb-4">
                            <label for="motivasi">Motivasi</label>
                            <textarea class="form-control" id="motivasi" name="motivasi" rows="5">{{ old("motivasi") }}</textarea>
                        </div>
                        <div id="result"><b style="font-size:16px;font-family:Arial">Jumlah Kata</b> : <b style="font-size:16px;font-family:Arial;color:#2980b9">0</b></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batalkan</button>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_dashboard/plugins/font-icons/fontawesome/css/fontawesome.css') }}">
    <link href="{{ asset('admin_dashboard/assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin_dashboard/assets/css/components/cards/card.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/elements/avatar.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <style>
        .nama-kelas {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 15px; }
        
        .card-user_name {
            font-size: 15px;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 3px;}

        .card-user_occupation {
            font-size: 14px;
            letter-spacing: 1px;
            margin-bottom: 0; }
    </style>
@endpush

@push('scripts')
    <script>
        function wordCount(val) {
            var wom = val.match(/\S+/g);
            return {
                charactersNoSpaces: val.replace(/\s+/g, '').length,
                characters: val.length,
                words: wom ? wom.length : 0,
                lines: val.split(/\r*\n/).length
            };
        }


        var textarea = document.getElementById('motivasi');
        var result = document.getElementById('result');

        textarea.addEventListener('input', function() {
            var wc = wordCount(this.value);
            result.innerHTML = (`
            <b style="font-size:16px;font-family:Arial">Jumlah Kata</b> : <b style="font-size:16px;font-family:Arial;color:#2980b9">${wc.words}</b>
            `);
        });
    </script>
@endpush