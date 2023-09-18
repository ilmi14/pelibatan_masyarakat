@extends('admin_dashboard.layouts.main')
@section('title')
    Kelas | Sibakat
@endsection

@section('content')
        
    <div class="row layout-top-spacing" id="cancel-row">
    
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('status'))
                    <div class="alert alert-success mb-4" role="alert"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                        <strong>{{ session('status') }} </strong>
                    </div>
                @endif
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKelas">Tambah Kelas</button>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#status" id="ubah_status" disabled>Ubah Status</button>
                <div class="table-responsive mb-4 mt-2">
                    <table id="tab_kelas" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="head-cb"></th>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th>Periode Belajar</th>
                                <th>Tutor</th>
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
    <!-- Modal -->
    <div class="modal fade" id="tambahKelas" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="modal-body select-tutor">
                        <div class="form-group">
                            <label for="banner">Banner</label><br>
                            <div class="custom-file mb-4">
                                <input type="file" class="custom-file-input" id="banner" name="banner" accept="image/*" required>
                                <label class="custom-file-label" for="banner">Pilih Gambar</label>
                            </div>
                            <div class="d-flex justify-content-center">
                                <img class="rounded img-fluid" src="{{ asset('admin_dashboard/assets/img/400x300.jpg') }}" alt="foto" id="preview" width="400px" height="300px">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>
                            <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" value="{{ old('nama_kelas') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_pendaftaran">Tanggal Pendaftaran</label>
                            <input id="tanggal_pendaftaran" name="tanggal_pendaftaran" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Pilih Tanggal Pendaftaran.." value="{{ old('tanggal_pendaftaran') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="periode_kelas">Periode Belajar</label>
                            <input id="periode_kelas" name="periode_kelas" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Pilih Periode Belajar.." value="{{ old('periode_kelas') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tutor">Tutor</label>
                            <select class="placeholder form-control" name="tutor_id">
                                <option value="">Pilih Tutor...</option>
                                @foreach ($tutor as $tutors)
                                    <option value="{{ $tutors->id }}" {{ (old("tutor_id") == $tutors->id ? "selected":"") }}>{{ $tutors->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="persyaratan">persyaratan Kelas</label>
                            <textarea name="persyaratan" class="textarea tinymce" id="editor1" rows="10">
                                {!! old('persyaratan') !!}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Kelas</label>
                            <textarea name="deskripsi" class="textarea tinymce" id="editor2" rows="10">
                                {!! old('deskripsi') !!}
                            </textarea>
                        </div>
                        <input type="hidden" name="status" value="Pendaftaran">
                        <div class="form-group">
                            <label for="Sasaran">Sasaran</label>
                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" name="TK_PAUD" class="new-control-input" value="1" {{ old('TK_PAUD') == '1' ? 'checked' : '' }}>
                                    <span class="new-control-indicator"></span>TK/PAUD
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" name="SD_MI" class="new-control-input" value="1" {{ old('SD_MI') == '1' ? 'checked' : '' }}>
                                    <span class="new-control-indicator"></span>SD/MI
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" name="SMP_MTS" class="new-control-input" value="1" {{ old('SMP_MTS') == '1' ? 'checked' : '' }}>
                                    <span class="new-control-indicator"></span>SMP/MTS
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" name="SMA_SMK_MA" class="new-control-input" value="1" {{ old('SMA_SMK_MA') == '1' ? 'checked' : '' }}>
                                    <span class="new-control-indicator"></span>SMA/SMK/MA
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" name="Mahasiswa" class="new-control-input" value="1" {{ old('Mahasiswa') == '1' ? 'checked' : '' }}>
                                    <span class="new-control-indicator"></span>Mahasiswa
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" name="Masyarakat_Umum" class="new-control-input" value="1" {{ old('Masyarakat Umum') == '1' ? 'checked' : '' }}>
                                    <span class="new-control-indicator"></span>Masyarakat Umum
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" name="ASN_Polri_TNI" class="new-control-input" value="1" {{ old('ASN/Polri/TNI') == '1' ? 'checked' : '' }}>
                                    <span class="new-control-indicator"></span>ASN/Polri/TNI
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batalkan</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="status" tabindex="-1" aria-labelledby="status" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="status">Ubah Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="ganti_status" action="{{ route('kelas.update.status') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control selectpicker" id="opsi_status" name="status" required>
                                <option value="Pendaftaran">Pendaftaran</option>
                                <option value="Kegiatan Berlangsung">Kegiatan Berlangsung</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batalkan</button>
                        <button type="button" onclick="gantiStatus()" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('admin_dashboard/plugins/table/datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/promise-polyfill.js') }}"></script>
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/forms/theme-checkbox-radio.css') }}">
    <link href="{{ asset('admin_dashboard/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/prismjs/prism.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/editors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/prismjs/prism.js') }}"></script>
    <script>
        $('#tab_kelas').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            ajax: "{{ route('kelas.index') }}",
            columns: [
                {data: 'checkbox', name: 'checkbox', searchable:false, orderable:false, sortable:false},
                {"width": "5%", data: 'DT_RowIndex', name: 'id'},
                {data: 'nama_kelas', name: 'nama_kelas'},
                {data: 'periode_kelas', name: 'periode_kelas'},
                {data: 'tutor_id', name: 'tutor_id'},
                {data: 'status', name: 'status', className: 'text-center'},
                {"width": "12%", data: 'aksi', name: 'aksi', orderable: false, searchable: false},
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
                        url:'{{url("/admin/kelas")}}/' +id,
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
        var f3 = flatpickr(document.getElementById('periode_kelas'), {
            mode: "range",
            minDate: "today",
            allowInput: true,
            onReady: function(selectedDates, dateStr, instance) {
                $(instance.altInput).prop('readonly', false);
            },
        });
        var f2 = flatpickr(document.getElementById('tanggal_pendaftaran'), {
            mode: "range",
            minDate: "today",
            allowInput: true,
            onReady: function(selectedDates, dateStr, instance) {
                $(instance.altInput).prop('readonly', false);
            },
        });
    </script>
    <script>
        $(".placeholder").select2({
            placeholder: "Pilih Tutor...",
            dropdownParent: $('.select-tutor')
        });
    </script>
    <script>
        $(".selectpicker").selectpicker({
            "title": "Pilih Status..."        
        }).selectpicker("render");
    </script>
    <script type='text/javascript'> 
        tinymce.init({
            selector: 'textarea.tinymce',
            // height: 500,
            plugins: 'fullscreen lists link image media codesample table wordcount autoresize',
            menubar: false,
            toolbar: 'fullscreen bold italic underline strikethrough subscript superscript | fontsize color | blocks alignment numlist bullist outdent indent blockquote | link image media codesample table | removeformat | undo redo',
            setup: (editor) => {
                editor.ui.registry.addGroupToolbarButton('alignment', {
                    icon: 'align-left',
                    tooltip: 'Alignment',
                    items: 'alignleft aligncenter alignright alignjustify'
                });
                editor.ui.registry.addGroupToolbarButton('color', {
                    icon: 'color-levels',
                    tooltip: 'Color',
                    items: 'forecolor backcolor'
                });
            },
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    </script>
    <script>
        $('#banner').on('change',function(e){
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        })
        banner.onchange = evt => {
            const [file] = banner.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
    <script>
        let yangDicheck = 0;
        $("#head-cb").on('click',function(){
            // if($(this).prop('checked')==true){
            //     $(".cb-child").prop('checked', true)
            // } else {
            //     $(".cb-child").prop('checked', false)
            // }
            var isChecked = $('#head-cb').prop('checked');
            $(".cb-child").prop('checked', isChecked);
            $('#ubah_status').prop('disabled',!isChecked);
        })

        $("#tab_kelas tbody").on('click','.cb-child', function(){
            if($(this).prop('checked')!=true){
                $("#head-cb").prop('checked', false);
            }
            
            let semuaCheckbox = $("#tab_kelas tbody .cb-child:checked")
            let childChecked = (semuaCheckbox.length>0)
            $('#ubah_status').prop('disabled',!childChecked);
        });

        function gantiStatus(){
            let status = $("#opsi_status :selected").text();
            let checkbox_dipilih = $("#tab_kelas tbody .cb-child:checked");
            let semua_id = [];
            $.each(checkbox_dipilih, function (index,elm){
                semua_id.push(elm.value);
            })
            $.ajax({
                "_token": "{{ csrf_token() }}",
                url:"{{ route('kelas.update.status') }}",
                method: 'put',
                data:{"_token": "{{ csrf_token() }}", ids: semua_id, status:status},
                success:function(res){
                    window.location.reload();
                }
            })
            // console.log(semua_id);
        };
    </script>
@endpush