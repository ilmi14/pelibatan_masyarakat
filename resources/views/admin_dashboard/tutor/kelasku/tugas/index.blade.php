@extends('admin_dashboard.layouts.main')
@section('title')
    Tugas | Sibakat
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

            <div class="widget-content widget-content-area br-6">
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#uploadTugas">
                    <i class="far fa-plus-square"></i> Buat Tugas
                </button>
                <div class="table-responsive">
                    <table id="data-peserta" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Batas Waktu</th>
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
    <div class="modal fade" id="uploadTugas" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('tutor.kelasku.tugas.store',[$kelas->id]) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Tugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_tugas">Nama Tugas</label>
                            <input type="text" class="form-control" id="nama_tugas" name="nama_tugas" placeholder="Nama Tugas" value="{{ old('nama_tugas') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="batas_waktu">Batas Waktu</label>
                            <input id="dateTimeFlatpickr" name="batas_waktu" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Pilih Waktu.." value="{{ old('batas_waktu') }}" required>
                        </div>
                        <div class="form-group">
                            <div class="custom-file-container" data-upload-id="mySecondImage">
                                <label>Upload File Tugas <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                <label class="custom-file-container__custom-file" >
                                    <input type="file" name="tugas[]" class="custom-file-container__custom-file__custom-file-input" multiple>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('admin_dashboard/plugins/table/datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/promise-polyfill.js') }}"></script>
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.js') }}"></script>
    <script>
        $('#data-peserta').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            ajax: "{{ route('tutor.kelasku.tugas.index', $kelas_id) }}",
            columns: [
                {"width": "5%", data: 'DT_RowIndex', name: 'id'},
                {data: 'nama_tugas', name: 'nama_tugas'},
                {data: 'deskripsi', name: 'deskripsi'},
                {data: 'batas_waktu', name: 'batas_waktu'},
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
    <script>
        var secondUpload = new FileUploadWithPreview('mySecondImage')
    </script>
    <script>
        function confirmDelete(e) {  
            let id = e.getAttribute('data-id');
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Anda tidak bisa mengembalikan ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Iya, hapus',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type:'DELETE',
                        url:'{{url("/tutor/kelasku/$kelas->id/tugas")}}/' +id,
                        data:{
                            "_token": "{{ csrf_token() }}",
                        },
                        success:function(data) {
                            if (data.success){
                                Swal.fire(
                                    'Berhasil dihapus',
                                    'Data berhasil dihapus.',
                                    "success"
                                );
                                $("#konfirmasiHapus"+id+"").parents('tr').remove()
                            }
                        }
                    });
                }
            }) 
        }
    </script>
    <script>
        var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            minDate: 'today',
            allowInput: true,
            onReady: function(selectedDates, dateStr, instance) {
                $(instance.altInput).prop('readonly', false);
            },
        });
    </script>
@endpush