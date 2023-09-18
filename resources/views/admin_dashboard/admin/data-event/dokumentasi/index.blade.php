@extends('admin_dashboard.layouts.main')
@section('title')
    Dokumentasi | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.admin.data-event.includes.navbar')
    
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
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
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#uploadDokumentasi">
                    <i class="far fa-plus-square"></i> Upload Dokumentasi
                </button>
                <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#uploadSlideshare">
                    <i class="far fa-plus-square"></i> Tambah Data dari Slideshare
                </button>
                <div class="table-responsive">
                    <table id="data-peserta" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Tipe</th>
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


    {{-- Addmore field --}}
    <div class="d-none">
        <div class="copy">
            <div class="control-group mb-3">
                <hr>
                <div class="form-group">
                    <label for="nama_file">Nama File</label>
                    <input id="name_file" name="nama_file[]" class="form-control" type="text" placeholder="Masukkan nama file">
                </div>
                <div class="form-group">
                    <label for="dokumentasi">Link Slideshare</label>
                    {{-- <input id="dokumentasi" name="dokumentasi[]" class="form-control" type="text" placeholder='pastekan link share embed dari slideshare'> --}}
                    <textarea name="dokumentasi[]" id="dokumentasi" class="form-control" rows="5" placeholder='pastekan link share embed dari slideshare'>{{ old('dokumentasi') }}</textarea>
                    <small>Untuk bagian link slideshare. Pada slideshare klik icon share lalu atur ukuran dan copy yang ada di embed</small>    
                </div>
                <button class="btn btn-danger remove" type="button">
                    Hapus
                </button>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    <div class="modal fade" id="uploadDokumentasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('data-event.dokumentasi.store',[$event->id]) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Dokumentasi Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="custom-file-container" data-upload-id="mySecondImage">
                                <label>Upload File Dokumentasi <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                <label class="custom-file-container__custom-file" >
                                    <input type="file" name="dokumentasi[]" class="custom-file-container__custom-file__custom-file-input" multiple>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uploadSlideshare" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('data-event.dokumentasi.store',[$event->id]) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data dari Slideshare</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="listDokumentasi">
                            <div class="control-group mb-3">
                                <div class="form-group">
                                    <label for="nama_file">Nama File</label>
                                    <input id="name_file" name="nama_file" class="form-control" type="text" placeholder="Masukkan nama file">
                                    {{-- <input id="name_file" name="nama_file[]" class="form-control" type="text" placeholder="Masukkan nama file"> --}}
                                </div>
                                <input type="hidden" name="tipe" value="Slideshare">
                                <div class="form-group">
                                    <label for="dokumentasi">Link Slideshare</label>
                                    <textarea name="dokumentasi" id="dokumentasi" class="form-control" rows="5" placeholder='pastekan link share embed dari slideshare'>{{ old('dokumentasi') }}</textarea>
                                    {{-- <textarea name="dokumentasi[]" id="dokumentasi" class="form-control" rows="5" placeholder='pastekan link share embed dari slideshare'>{{ old('dokumentasi') }}</textarea> --}}
                                    {{-- <input id="dokumentasi" name="dokumentasi[]" class="form-control" type="text" placeholder='pastekan link share embed dari slideshare'> --}}
                                    <small>Untuk bagian link slideshare. Pada slideshare klik icon share lalu atur ukuran dan copy yang ada di embed</small>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                            <span class="mr-auto">
                                {{-- <button class="btn btn-success add-more" type="button">
                                    Tambah
                                </button> --}}
                            </span>
                            <span>
                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </span>
                        </div>
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
    <link href="{{ asset('admin_dashboard/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/promise-polyfill.js') }}"></script>
    <link href="{{ asset('admin_dashboard/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/table/datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
    <script>
        $('#data-peserta').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            ajax: "{{ route('data-event.dokumentasi.index', $event->id) }}",
            columns: [
                {"width": "5%", data: 'DT_RowIndex', name: 'id'},
                {data: 'nama_file', name: 'nama_file'},
                {data: 'tipe', name: 'tipe'},
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
                        url:'{{ url("/admin/data-event/$event->id/dokumentasi") }}/' +id,
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
    <script type="text/javascript">
        $(document).ready(function() {
            $(".add-more").click(function(){ 
                var html = $(".copy").html();
                $("#listDokumentasi").append(html);
            });
        
            // saat tombol remove dklik control group akan dihapus 
            $("body").on("click",".remove",function(){ 
                $(this).parents(".control-group").remove();
            });
        });
    </script>
@endpush