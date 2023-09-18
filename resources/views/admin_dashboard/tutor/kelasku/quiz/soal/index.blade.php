@extends('admin_dashboard.layouts.main')
@section('title')
    Soal Quiz | Sibakat
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
                <a href="{{ route('tutor.kelasku.quiz.index', [$kelas->id]) }}" class="btn btn-secondary mb-3">
                    <i class="far fa-arrow-alt-circle-left"></i> Kembali ke halaman quiz
                </a>
                <a href="{{ route('tutor.kelasku.quiz.soal.create', [$kelas->id, $quiz_id]) }}" class="btn btn-primary mb-3">
                    <i class="far fa-plus-square"></i> Tambah Soal
                </a>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#status" id="ubah_status" disabled>Ubah Aktif</button>
                <div class="table-responsive">
                    <table id="soal-quiz" class="table table-hover table-bordered alignment_top" style="width:100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="head-cb"></th>
                                <th>No.</th>
                                <th>Soal</th>
                                <th class="text-center">Aktif</th>
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
<div class="modal fade" id="status" tabindex="-1" aria-labelledby="status" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status">Ubah Aktif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ganti_status" action="{{ route('tutor.kelasku.quiz.soal.update.status', [$kelas_id, $quiz_id]) }}" method="post">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="aktif">Aktif</label>
                        <select class="form-control selectpicker" id="opsi_status" name="aktif" required>
                            <option value="Y">Aktif</option>
                            <option value="N">Tidak Aktif</option>
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
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('admin_dashboard/plugins/table/datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/promise-polyfill.js') }}"></script>
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/forms/theme-checkbox-radio.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/table/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.js') }}"></script>
    <script>
        $('#soal-quiz').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[1, 'asc']],
            ajax: "{{ route('tutor.kelasku.quiz.soal.index', [$kelas_id, $quiz_id]) }}",
            columns: [
                {"width": "5%", data: 'checkbox', name: 'checkbox', searchable:false, orderable:false, sortable:false},
                {"width": "5%", data: 'DT_RowIndex', name: 'id'},
                {data: 'soal', name: 'soal'},
                {data: 'aktif', name: 'aktif', className: 'text-center', orderable: false, searchable: false},
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
        var f1 = flatpickr(document.getElementById('basicFlatpickr'),{
            minDate: "today",
            dateFormat: "j F Y",
            allowInput: true,
            onReady: function(selectedDates, dateStr, instance) {
                $(instance.altInput).prop('readonly', false);
            },
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
                        url:'{{url("/tutor/kelasku/$kelas->id/quiz/$quiz_id/soal")}}/' +id,
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
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
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

        $("#soal-quiz tbody").on('click','.cb-child', function(){
            if($(this).prop('checked')!=true){
                $("#head-cb").prop('checked', false);
            }
            
            let semuaCheckbox = $("#soal-quiz tbody .cb-child:checked")
            let childChecked = (semuaCheckbox.length>0)
            $('#ubah_status').prop('disabled',!childChecked);
        });

        function gantiStatus(){
            let aktif = $("#opsi_status :selected").val();
            let checkbox_dipilih = $("#soal-quiz tbody .cb-child:checked");
            let semua_id = [];
            $.each(checkbox_dipilih, function (index,elm){
                semua_id.push(elm.value);
            })
            $.ajax({
                "_token": "{{ csrf_token() }}",
                url:"{{ route('tutor.kelasku.quiz.soal.update.status', [$kelas_id, $quiz_id]) }}",
                method: 'put',
                data:{"_token": "{{ csrf_token() }}", ids: semua_id, aktif:aktif},
                success:function(res){
                    window.location.reload();
                }
            })
            // console.log(semua_id);
        };
    </script>
@endpush