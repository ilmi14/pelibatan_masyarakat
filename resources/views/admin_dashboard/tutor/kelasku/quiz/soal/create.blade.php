@extends('admin_dashboard.layouts.main')
@section('title')
    Buat Quiz | Sibakat
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
                <form id="form" action="{{ route('tutor.kelasku.quiz.soal.store', [$kelas->id, $quiz->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <h3>Soal</h3>
                    <section>
                        <div id="listSoal">
                            <div class="control-group card mb-3">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="soal[]">Soal</label>
                                        <textarea class="form-control" id="soal[]" name="soal[]" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="file[]">File (Audio, Gambar, Video)</label>
                                        <input type="file" name="file[]" id="file[]" accept="image/*, video/*, audio/*">
                                    </div>
                                    <ol type="A">
                                        <li>
                                            <input type="text" class="form-control ml-2 my-3" id="a[]" name="a[]" placeholder="Jawaban A." required>
                                        </li>
                                        <li>                                            
                                            <input type="text" class="form-control ml-2 my-3" id="b[]" name="b[]" placeholder="Jawaban B." required>
                                        </li>
                                        <li>
                                            <input type="text" class="form-control ml-2 my-3" id="c[]" name="c[]" placeholder="Jawaban C." required>
                                        </li>
                                        <li>
                                            <input type="text" class="form-control ml-2 my-3" id="d[]" name="d[]" placeholder="Jawaban D." required>
                                        </li>
                                    </ol>
                                    <div class="form-group">
                                        <label for="kunci_jawaban[]">Kunci Jawaban</label>
                                        <select class="form-control" id="kunci_jawaban[]" name="kunci_jawaban[]" required>
                                            <option value="" hidden selected>Pilih Kunci Jawaban</option>
                                            <option value="A">A.</option>
                                            <option value="B">B.</option>
                                            <option value="C">C.</option>
                                            <option value="D">D.</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pembahasan[]">Pembahasan (Opsional)</label>
                                        <textarea class="form-control" id="pembahasan[]" name="pembahasan[]" rows="2"></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-success add-more" type="button">
                                            Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tutor.kelasku.quiz.soal.index', [$kelas->id, $quiz->id]) }}" class="btn btn-sm btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="d-none">
        <div class="copy">
            <div class="control-group card mb-3">
                <div class="card-body">
                    <div class="form-group">
                        <label for="soal[]">Soal</label>
                        <textarea class="form-control" id="soal[]" name="soal[]" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file[]">File (Audio, Gambar, Video)</label>
                        <input type="file" name="file[]" id="file[]" accept="image/*, video/*, audio/*" multiple>
                    </div>
                    <ol type="A">
                        <li>
                            <input type="text" class="form-control ml-2 my-3" id="a[]" name="a[]" placeholder="Jawaban A.">
                        </li>
                        <li>                                            
                            <input type="text" class="form-control ml-2 my-3" id="b[]" name="b[]" placeholder="Jawaban B.">
                        </li>
                        <li>
                            <input type="text" class="form-control ml-2 my-3" id="c[]" name="c[]" placeholder="Jawaban C.">
                        </li>
                        <li>
                            <input type="text" class="form-control ml-2 my-3" id="d[]" name="d[]" placeholder="Jawaban D.">
                        </li>
                    </ol>
                    <div class="form-group">
                        <label for="kunci_jawaban[]">Kunci Jawaban</label>
                        <select class="form-control" name="kunci_jawaban[]">
                            <option value="" hidden selected>Pilih Kunci Jawaban</option>
                            <option value="A">A.</option>
                            <option value="B">B.</option>
                            <option value="C">C.</option>
                            <option value="D">D.</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pembahasan[]">Pembahasan <sup>(Opsional)</sup></label>
                        <textarea class="form-control" id="pembahasan[]" name="pembahasan[]" rows="2"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-danger remove" type="button">
                            Hapus
                        </button>
                    </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $(".add-more").click(function(){ 
                var html = $(".copy").html();
                $("#listSoal").append(html);
            });
        
            // saat tombol remove dklik control group akan dihapus 
            $("body").on("click",".remove",function(){ 
                $(this).parents(".control-group").remove();
            });
        });
    </script>
@endpush