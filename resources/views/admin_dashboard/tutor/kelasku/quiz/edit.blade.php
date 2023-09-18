@extends('admin_dashboard.layouts.main')
@section('title')
    Edit Quiz | Sibakat
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
                <form action="{{ route('tutor.kelasku.quiz.update', [$kelas->id, $quiz->id]) }}" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_quiz">Nama quiz</label>
                            <input type="text" class="form-control" id="nama_quiz" name="nama_quiz" value="{{ $quiz->nama_quiz }}" required>
                        </div> 
                        <div class="form-group">
                            <label for="tanggal_quiz">Tanggal Quiz</label>
                            <input id="basicFlatpickr" name="tanggal_quiz" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Pilih Waktu.." value="{{ \Carbon\Carbon::parse($quiz->tanggal_quiz)->format('j F Y') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="waktu_pengerjaan">Waktu Pengerjaan (Dalam Menit)</label>
                            <input name="waktu_pengerjaan" class="form-control" type="text" onkeypress="return isNumber(event)" placeholder="Cth : 60" value="{{ $quiz->waktu_pengerjaan }}" required>
                        </div>
                        <div class="form-group">
                            <label for="aktif">Aktif?</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="aktif1" value="Y" name="aktif" class="custom-control-input" {{ ($quiz->aktif == 'Y') ? 'checked': '' }} required="required">
                                <label class="custom-control-label" for="aktif1">Ya</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="aktif2" value="N" name="aktif" class="custom-control-input" {{ ($quiz->aktif == 'N') ? 'checked': '' }}>
                                <label class="custom-control-label" for="aktif2">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batalkan</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('modal')

@endpush

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/forms/theme-checkbox-radio.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.js') }}"></script>
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
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
@endpush