@extends('admin_dashboard.layouts.main')
@section('title')
    Presensi | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.tutor.kelasku.includes.navbar')
        
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
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive">
                    <table id="data-peserta" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Presensi Buka</th>
                                <th>Presensi Tutup</th>
                                <th>Status</th>
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
    @foreach ($presensi as $presensi)
        <div class="modal fade" id="isiPresensi{{ $presensi->id }}" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('tutor.kelasku.presensi.store',[$kelas->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mengisi Presensi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center mt-2">
                                <input type="hidden" name="presensi_id" value="{{ $presensi->id }}">
                                <div class="n-chk">
                                    <label class="new-control new-radio new-radio-text radio-primary">
                                        <input type="radio" class="new-control-input" value="Hadir" name="status">
                                        <span class="new-control-indicator"></span><span class="new-radio-content">Hadir</span>
                                    </label>
                                    <label class="new-control new-radio new-radio-text radio-primary">
                                        <input type="radio" class="new-control-input" value="Tidak Hadir" name="status">
                                        <span class="new-control-indicator"></span><span class="new-radio-content">Tidak Hadir</span>
                                    </label>
                                    <label class="new-control new-radio new-radio-text radio-primary">
                                        <input type="radio" class="new-control-input" value="Sakit" name="status">
                                        <span class="new-control-indicator"></span><span class="new-radio-content">Sakit</span>
                                    </label>
                                    <label class="new-control new-radio new-radio-text radio-primary">
                                        <input type="radio" class="new-control-input" value="Izin" name="status">
                                        <span class="new-control-indicator"></span><span class="new-radio-content">Izin</span>
                                    </label>
                                </div>
                            </div>
                            @if ($presensi->foto == "Ya")
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" accept="image/*" name="gambar" capture required>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batalkan</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/forms/theme-checkbox-radio.css') }}">
    <link href="{{ asset('admin_dashboard/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $('#data-peserta').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            ajax: "{{ route('tutor.kelasku.presensi.index', $kelas_id) }}",
            columns: [
                {"width": "5%", data: 'DT_RowIndex', name: 'id'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'tanggal_mulai', name: 'tanggal_mulai'},
                {data: 'tanggal_berakhir', name: 'tanggal_berakhir'},
                {data: 'status', name: 'status'},
                {"width": "18%", data: 'aksi', name: 'aksi', className: 'text-center', orderable: false, searchable: false},
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
@endpush