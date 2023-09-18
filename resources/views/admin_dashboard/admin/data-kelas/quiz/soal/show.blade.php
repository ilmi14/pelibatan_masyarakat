@extends('admin_dashboard.layouts.main')
@section('title')
    Lihat Soal Quiz | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.admin.data-kelas.includes.navbar')
    
    <div class="row layout-top-spacing">
        
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">

            <div class="widget-content-area br-4">
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
                <h3>Soal</h3>
                <section>
                    <div id="listSoal">
                        <div class="control-group card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <p>{{ $soal->soal }}</p>
                                </div>
                                <div class="mb-3">
                                    @if ($soal->file_extension == 'jpg' || $soal->file_extension == 'jpeg' || $soal->file_extension == 'png')
                                        <img src="{{ Storage::url($soal->file) }}" class="img-fluid" alt="...">
                                    @elseif($soal->file_extension == 'mp4')
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <video class="embed-responsive-item" controls>
                                                <source src="{{ Storage::url($soal->file) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    @elseif($soal->file_extension == 'mp3')
                                        <audio controls>
                                            <source src="{{ Storage::url($soal->file) }}" type="audio/mpeg">
                                            Your browser does not support the audio tag.
                                        </audio>
                                    @endif
                                </div>
                                <ol type="A">
                                    @if($soal->kunci_jawaban == 'A') 
                                        <li class="text-success">{{ $soal->a }} <i class="far fa-check-circle"></i></li>
                                        <li>{{ $soal->b }}</li>
                                        <li>{{ $soal->c }}</li>
                                        <li>{{ $soal->d }}</li>
                                    @elseif($soal->kunci_jawaban == 'B') 
                                        <li>{{ $soal->a }}</li>
                                        <li class="text-success">{{ $soal->b }} <i class="far fa-check-circle"></i></li>
                                        <li>{{ $soal->c }}</li>
                                        <li>{{ $soal->d }}</li>
                                    @elseif($soal->kunci_jawaban == 'C') 
                                        <li>{{ $soal->a }}</li>
                                        <li>{{ $soal->b }}</li>
                                        <li class="text-success">{{ $soal->c }} <i class="far fa-check-circle"></i></li>
                                        <li>{{ $soal->d }}</li>
                                    @elseif($soal->kunci_jawaban == 'D') 
                                        <li>{{ $soal->a }}</li>
                                        <li>{{ $soal->b }}</li>
                                        <li>{{ $soal->c }}</li>
                                        <li class="text-success">{{ $soal->d }} <i class="far fa-check-circle"></i></li>
                                    @else
                                        <li>{{ $soal->a }}</li>
                                        <li>{{ $soal->b }}</li>
                                        <li>{{ $soal->c }}</li>
                                        <li>{{ $soal->d }}</li>
                                    @endif
                                </ol>
                                @if ($soal->pembahasan != null)
                                    <div>
                                        <strong>Pembahasan</strong>
                                        <p>{{ $soal->pembahasan }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('data-kelas.quiz.soal.index', [$kelas->id, $soal->quiz->id]) }}" class="btn btn-sm btn-secondary">Kembali</a>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/forms/theme-checkbox-radio.css') }}">
    <style>
        .btn-light { border-color: transparent; }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script>
        var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
            minDate: "today",
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            allowInput: true,
            onReady: function(selectedDates, dateStr, instance) {
                $(instance.altInput).prop('readonly', false);
            },
        });
    </script>
    <script>
        $(".selectpicker").selectpicker({
            "title": "Pilih Menu"
        }).selectpicker("render");
    </script>
@endpush