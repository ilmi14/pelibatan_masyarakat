@extends('admin_dashboard.layouts.main')
@section('title')
    Info Event | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.peserta.eventku.includes.navbar')
    @if (\Carbon\Carbon::now()->format('Y-m-d') > $event->tanggal_berakhir)
        @if ($registrasi->sertifikat == "Terbit")
            <div class="card bg-success mb-3">
                <div class="card-body">
                    <p class="text-white">Selamat kamu sudah bisa unduh sertifikat {{ $event->nama_event }}!</p>
                    <a href="{{ url('peserta/eventku/'.$event->id.'/sertifikat') }}" class="btn btn-info" title="Lihat Sertifikat">Lihat Sertifikat</a>
                </div>
            </div>
        @elseif ($registrasi->sertifikat == "Tidak Terbit")
            <div class="card bg-danger mb-3">
                <div class="card-body">
                    <p class="text-white">Mohon maaf kami tidak bisa menerbitkan sertifikat {{ $event->nama_event }}. dikarenakan belum memenuhi syarat dan ketentuan</p>
                    <p class="text-white">Berikut ini alasan kami tidak bisa menerbitkan sertifikat anda: <br> {{ $registrasi->catatan_sertifikat }}</p>
                </div>
            </div>
        @else
            <div class="card mb-3">
                <div class="card-body bg-warning">
                    <p class="text-white"><strong>Mohon menunggu.</strong> Saat ini admin sedang mempersiapkan sertifikat anda di {{ $event->kategori . ' ' . $event->nama_event }}!</p>
                </div>
            </div>
        @endif
    @endif

    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                @if ($event->banner != null)            
                    <img src="{{ Storage::url($event->banner) }}" height="300px" width="400px" style="object-fit: cover" class="" alt="widget-card-2">
                @else
                    <img src="{{ asset('admin_dashboard/assets/img/400x300.jpg') }}" class="img-fluid" alt="widget-card-2">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <div>
                        <span class="badge badge-secondary mb-3">{{ $event->kategori }}</span>
                    </div>
                    <h5 class="card-title">{{ $event->nama_event }}</h5>
                    <div class="mb-2">
                        <span>Oleh: 
                            <span class="text-muted">{{ $event->pembuat_event }}</span>
                        </span>
                    </div>
                    <div class="mb-2">
                        <div class="text-for-element">Jadwal Pelaksanaan</div>
                        <div class="row">
                            <div class="col-sm-3">Mulai</div>
                            <div class="col-sm-9">: 
                                <b>{{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('j F Y')}}</b> 
                                {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('H:i')}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">Selesai</div>
                            <div class="col-sm-9">: 
                                <b>{{ \Carbon\Carbon::parse($event->tanggal_berakhir)->format('j F Y')}}</b> 
                                {{ \Carbon\Carbon::parse($event->tanggal_berakhir)->format('H:i')}}
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <span>Lokasi:
                            <span class="text-muted">{{ $event->lokasi }}</span>
                        </span>
                    </div>
                    <div class="mb-2">
                        @if($event->status == 'Selesai')
                            <p class="card-text"><span class="badge badge-dark">Event Telah Berakhir</span></p>
                        @else
                            <div class="row">
                                <div class="col-sm-3">Batas Pendaftaran</div>
                                <div class="col-sm-9">: 
                                    <b>{{ \Carbon\Carbon::parse($event->deadline_pendaftaran)->format('j F Y')}}</b> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Kuota</div>
                                <div class="col-sm-9">: 
                                    <strong>{{ $event->kuota }}</strong>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="widget-content widget-content-area">
        <h3>Deskripsi</h3>
        {!! $event->deskripsi !!}   
    </div>
@endsection

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link href="{{ asset('admin_dashboard/assets/css/components/cards/card.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    
@endpush