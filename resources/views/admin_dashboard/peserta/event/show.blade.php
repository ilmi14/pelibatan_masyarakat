@extends('admin_dashboard.layouts.main')
@section('title')
    Detail Event | Sibakat
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
                <div class="card">
                    @if($event->banner != null)
                        <img src="{{ Storage::url($event->banner) }}" width="400" height="300" style="object-fit: cover" class="card-img-top" alt="...">
                    @else
                        <img src="{{ asset('admin_dashboard/assets/img/400x300.jpg') }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <div>
                            <span class="badge badge-secondary mb-3">{{ $event->kategori }}</span>
                        </div>
                        <h5 class="card-title">{{ $event->nama_event }}</h5>
                        <div class="mb-3">
                            <span>Oleh: 
                                <span class="text-muted">{{ $event->pembuat_event }}</span>
                            </span>
                        </div>
                        <div class="mb-3">
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
                        <div class="mb-3">
                            <span>Lokasi:
                                <span class="text-muted">{{ $event->lokasi }}</span>
                            </span>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-4">Batas Pendaftaran</div>
                                <div class="col-sm-8">: 
                                    <b>{{ \Carbon\Carbon::parse($event->deadline_pendaftaran)->format('j F Y')}}</b> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">Sisa Kuota</div>
                                <div class="col-sm-8">: 
                                    <strong>{{ $kuota }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if($event->deadline_pendaftaran > \Carbon\Carbon::now()->format('Y-m-d'))
                            @if ($kuota > 0)    
                                @if($registrasi_event != null)
                                    <button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" disabled>
                                        Terimakasih sudah mendaftar
                                    </button>
                                @elseif(Auth::user()->status == 'Belum Verifikasi')
                                    <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" disabled>
                                        Verifikasi akun terlebih dahulu
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">
                                        Daftar Sekarang
                                    </button>
                                @endif
                            @else
                                @if($registrasi_event != null)
                                    <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" disabled>
                                        Terimakasih sudah mendaftar
                                    </button>
                                @else
                                    <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" disabled>
                                        Maaf, kuota pendaftaran sudah habis
                                    </button>
                                @endif
                            @endif
                        @else
                            <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" disabled>
                                Maaf, pendaftaran sudah ditutup
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">
            <div class="layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">Deskripsi</h3>
                    {!! $event->deskripsi !!}
                </div>                                
            </div>
        </div>

    </div>

@endsection

@push('modal')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('peserta.event.daftar', [$event->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        Apakah anda yakin untuk mendaftar event ini?
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
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
    <link rel="stylesheet" href="{{ asset('admin_dashboard/plugins/font-icons/fontawesome/css/fontawesome.css') }}">
    <link href="{{ asset('admin_dashboard/assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin_dashboard/assets/css/components/cards/card.css')}}" rel="stylesheet" type="text/css" />
    <link href="assets/css/elements/avatar.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
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

@endpush