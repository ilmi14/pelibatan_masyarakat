@extends('admin_dashboard.layouts.main')
@section('title')
    Edit Soal Quiz | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.tutor.kelasku.includes.navbar')
    
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
                <form id="form" action="{{ route('tutor.kelasku.quiz.soal.update', [$kelas->id, $soal->quiz->id, $soal->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <h3>Soal</h3>
                    <section>
                        <div id="listSoal">
                            <div class="control-group card mb-3">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="soal">Soal</label>
                                        <textarea class="form-control" id="soal" name="soal" rows="2" required>{{ $soal->soal }}</textarea>
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
                                    <div class="form-group">
                                        <label for="file">File (Audio, Gambar, Video)</label>
                                        <input type="file" name="file" id="file" accept="image/*, video/*, audio/*">
                                    </div>
                                    <ol type="A">
                                        <li>
                                            <input type="text" class="form-control ml-2 my-3" id="a" name="a" value="{{ $soal->a }}" placeholder="Jawaban A.">
                                        </li>
                                        <li>                                            
                                            <input type="text" class="form-control ml-2 my-3" id="b" name="b" value="{{ $soal->b }}" placeholder="Jawaban B.">
                                        </li>
                                        <li>
                                            <input type="text" class="form-control ml-2 my-3" id="c" name="c" value="{{ $soal->c }}" placeholder="Jawaban C.">
                                        </li>
                                        <li>
                                            <input type="text" class="form-control ml-2 my-3" id="d" name="d" value="{{ $soal->d }}" placeholder="Jawaban D.">
                                        </li>
                                    </ol>
                                    <div class="form-group">
                                        <label for="kunci_jawaban">Kunci Jawaban</label>
                                        <select class="form-control" id="kunci_jawaban" name="kunci_jawaban">
                                            <option value="" hidden selected>Pilih Kunci Jawaban</option>
                                            <option value="A" {{ ($soal->kunci_jawaban == 'A') ? 'selected': '' }}>A.</option>
                                            <option value="B" {{ ($soal->kunci_jawaban == 'B') ? 'selected': '' }}>B.</option>
                                            <option value="C" {{ ($soal->kunci_jawaban == 'C') ? 'selected': '' }}>C.</option>
                                            <option value="D" {{ ($soal->kunci_jawaban == 'D') ? 'selected': '' }}>D.</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pembahasan">Pembahasan <sup>(Opsional)</sup></label>
                                        <textarea class="form-control" id="pembahasan" name="pembahasan" rows="2">{{ $soal->pembahasan }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tutor.kelasku.quiz.soal.index', [$kelas->id, $soal->quiz->id]) }}" class="btn btn-sm btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
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