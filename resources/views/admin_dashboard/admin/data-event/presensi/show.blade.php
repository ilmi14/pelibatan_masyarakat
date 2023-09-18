@extends('admin_dashboard.layouts.main')
@section('title')
    Detail Presensi | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.admin.data-event.includes.navbar')

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
            <div class="widget-content-area br-4 mb-3">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td style="width: 15%">Kegiatan</td>
                                <td style="width: 1%">:</td>
                                <td>{{ $presensi->event->nama_event }}</td>
                            </tr>
                            <tr>
                                <td>Presensi Buka</td>
                                <td>:</td>
                                <td><span class="badge badge-info">{{ \Carbon\Carbon::parse($presensi->tanggal_mulai)->format('j F Y H:i') }}</span></td>
                            </tr>
                            <tr>
                                <td>Presensi Tutup</td>
                                <td>:</td>
                                <td><span class="badge badge-warning">{{ \Carbon\Carbon::parse($presensi->tanggal_berakhir)->format('j F Y H:i') }}</span></td>
                            </tr>
                            <tr>
                                <td>Dengan Foto</td>
                                <td>:</td>
                                <td>{{ $presensi->foto }}</td>
                            </tr>
                        </tbody>
                    </table>  
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('data-event.presensi.index', [$event->id]) }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ url('/admin/data-event/'. $event->id .'/presensi/'.$presensi->id.'/export') }}" class="btn btn-primary">Download Data Kehadiran</a>
                </div>
            </div>

            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    <h5 class="card-title">Data Presensi Peserta</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Tipe Anggota</th>
                                <th>Waktu Mengisi</th>
                                <th>Status</th>
                                @if ($presensi->foto == "Ya") 
                                    <th>Gambar</th>
                                @endif
                            </thead>
                            <tbody>
                                @if (count($dataPresensi) > 0)
                                    @foreach ($dataPresensi as $dataPresensi)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dataPresensi->nama }}</td>
                                            <td>{{ $dataPresensi->tipe_anggota }}</td>
                                            @if ($dataPresensi->presensi_event_id != null && $dataPresensi->presensi_event_status != "Tidak Hadir")
                                                <td>{{ \Carbon\Carbon::parse($dataPresensi->created_at)->format('j F Y H:i') }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            @if ($dataPresensi->presensi_event_status)
                                                <td><span class="badge badge-info">{{ $dataPresensi->presensi_event_status }}</span></td>
                                            @elseif(\Carbon\Carbon::now() > $presensi->tanggal_berakhir && $dataPresensi->presensi_event_status == null) 
                                                <td><span class="badge badge-danger">Tidak Hadir</span></td>
                                            @else
                                                <td><span class="badge badge-warning">Belum Mengisi</span></td>
                                            @endif
                                            @if ($presensi->foto == "Ya") 
                                                @if ($dataPresensi->gambar != null)
                                                    <td>
                                                        <a data-fancybox="gallery" href="{{ Storage::url($dataPresensi->gambar) }}">
                                                            <img class="rounded" src="{{ Storage::url($dataPresensi->gambar) }}" width="100" height="75" />
                                                        </a>
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>  
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    
@endpush

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-media_object.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('admin_dashboard/plugins/fancybox/fancybox.css') }}"/>
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/fancybox/fancybox.umd.js') }}"></script>
@endpush