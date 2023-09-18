@extends('admin_dashboard.layouts.main')
@section('title')
    Kelas | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.admin.data-kelas.includes.navbar')

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            @if(session('status'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        {{ session('status') }}
                    </div>
                </div>
            @endif
            
            <div class="widget-content widget-content-area br-6">
                <a href="{{ url('admin/data-kelas/'.$kelas_id.'/peserta/export') }}" class="btn btn-primary">Download Data Peserta</a>
                <a href="{{ url('admin/data-kelas/'.$kelas_id.'/peserta/export-diterima') }}" class="btn btn-secondary">Download Data Peserta yang Diterima</a>
                <div class="table-responsive mb-4 mt-4">
                    <table id="data-peserta" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Tipe Anggota</th>
                                <th>Nomor Telepon</th>
                                <th>Alamat</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('modal')
    @foreach ($dataPeserta as $dataPeserta)
    <div class="modal fade" id="lihat{{ $dataPeserta->id }}" tabindex="-1" aria-labelledby="data_peserta" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="data_peserta">Data Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 22%">Tanggal Mendaftar</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ \Carbon\Carbon::parse($dataPeserta->created_at)->format('j F Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ $dataPeserta->user->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Umur</td>
                                    <td>:</td>
                                    @php
                                        $hari_ini = Carbon\Carbon::now();
                                        $tanggal_lahir = Carbon\Carbon::parse($dataPeserta->user->tanggal_lahir);
                                        $umur = $tanggal_lahir->diffInYears($hari_ini); 
                                    @endphp
                                    <td>{{ $umur }}</td>
                                </tr>
                                <tr>
                                    <td>Tempat Lahir</td>
                                    <td>:</td>
                                    <td>{{ ucwords(strtolower(\Indonesia::findCity($dataPeserta->user->tempat_lahir)->name)) }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($dataPeserta->user->tanggal_lahir)->format('j F Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>{{ $dataPeserta->user->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td>Tipe Anggota</td>
                                    <td>:</td>
                                    <td>{{ $dataPeserta->user->tipe_anggota }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon</td>
                                    <td>:</td>
                                    <td>{{ $dataPeserta->user->nomor_telepon }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $dataPeserta->user->alamat. ', ' .ucwords(strtolower(\Indonesia::findVillage($dataPeserta->user->desa_kelurahan)->name)). ', ' .ucwords(strtolower(\Indonesia::findDistrict($dataPeserta->user->kecamatan)->name)). ', ' .ucwords(strtolower(\Indonesia::findCity($dataPeserta->user->kabupaten_kota)->name)). ', ' .ucwords(strtolower(\Indonesia::findProvince($dataPeserta->user->provinsi)->name)) }}</td>
                                </tr>
                                <tr>
                                    <td>Motivasi</td>
                                    <td>:</td>
                                    <td>{{ $dataPeserta->motivasi }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>
                                        @if ($dataPeserta->status == 'Diterima')
                                            <span class="badge badge-success">{{ $dataPeserta->status }}</span>
                                        @elseif($dataPeserta->status == 'Ditolak')
                                            <span class="badge badge-danger">{{ $dataPeserta->status }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $dataPeserta->status }}</span>    
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td>:</td>
                                    <td>{{ $dataPeserta->catatan }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batalkan</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endpush

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('admin_dashboard/plugins/table/datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    <link href="{{ asset('admin_dashboard/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script>
        $('#data-peserta').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[1, 'asc']],
            ajax: "{{ route('data-kelas.peserta.index', $kelas_id) }}",
            columns: [
                {"width": "5%", data: 'DT_RowIndex', name: 'id'},
                {data: 'user.nama', name: 'user.nama'},
                {data: 'umur', name: 'umur'},
                {data: 'user.tipe_anggota', name: 'user.tipe_anggota'},
                {data: 'user.nomor_telepon', name: 'user.nomor_telepon'},
                {data: 'user.alamat', name: 'user.alamat'},
                {data: 'status', name: 'status', className: 'text-center'},
                {"width": "12%", data: 'aksi', name: 'aksi', className: 'text-center', orderable: false, searchable: false},
            ],
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        });
    </script>
    <script>
        $(".selectpicker").selectpicker({
            "title": "Pilih Status..."        
        }).selectpicker("render");
    </script>
@endpush