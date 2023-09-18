@extends('admin_dashboard.layouts.main')
@section('title')
    Hasil Penilaian Quiz | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.peserta.kelasku.includes.navbar')
    
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">


            <div class="widget-content-area mb-3">
                <div class="table-responsive">
                    <table class="w-70">
                        <tbody>
                            <input type="hidden" id="quiz_id" value="{{ $informasiQuiz->id }}"> 
                            <tr>
                                <td><b>Judul Kuis</b></td>
                                <td>: {{ $informasiQuiz->nama_quiz }}</td>
                            <tr>
                            </tr>
                                <td><b>Tanggal Quiz</b></td>
                                <td>: {{ \Carbon\Carbon::parse($informasiQuiz->tanggal_quiz)->format('j F Y') }}</td>
                            </tr>
                            <tr>
                                <td><b>Waktu Pengerjaan</b></td>
                                <td>: {{ $informasiQuiz->waktu_pengerjaan }} Menit</td>
                            </tr>
                            <tr>
                                <td><b>Jumlah Soal</b></td>
                                <td>: {{ count($informasiQuiz->quizSoal) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="widget-content-area br-4">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="far fa-times-circle"></i></button>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h3>Soal</h3>
                <section>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No.</th>
                                    <th class="text-center">Soal</th>
                                    <th class="text-center" width="15%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $jawabanBenar = 0;
                                @endphp
                                @foreach ($quiz as $index=>$jawaban)
                                    @php
                                        $soal = $jawaban->quizSoal
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $index+1 }}</td>
                                        <td>
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
                                                @if(!empty($jawaban->jawaban))   
                                                    @if($soal->kunci_jawaban == 'A') 
                                                        <li class="text-success">{{ $soal->a }} <i class="far fa-check-circle"></i></li>
                                                        @if ($jawaban->jawaban == 'B')
                                                            <li class="text-danger">{{ $soal->b }} <i class="far fa-times-circle"></i></li>
                                                        @else
                                                            <li>{{ $soal->b }}</li>
                                                        @endif
                                                        @if ($jawaban->jawaban == 'C')
                                                            <li class="text-danger">{{ $soal->c }} <i class="far fa-times-circle"></i></li>
                                                        @else
                                                            <li>{{ $soal->c }}</li>
                                                        @endif
                                                        @if ($jawaban->jawaban == 'D')
                                                            <li class="text-danger">{{ $soal->d }} <i class="far fa-times-circle"></i></li>
                                                        @else
                                                            <li>{{ $soal->d }}</li>
                                                        @endif
                                                    @elseif($soal->kunci_jawaban == 'B') 
                                                        @if ($jawaban->jawaban == 'A')
                                                            <li class="text-danger">{{ $soal->a }} <i class="far fa-times-circle"></i></li>
                                                        @else
                                                            <li>{{ $soal->a }}</li>
                                                        @endif
                                                        <li class="text-success">{{ $soal->b }} <i class="far fa-check-circle"></i></li>
                                                        @if ($jawaban->jawaban == 'C')
                                                            <li class="text-danger">{{ $soal->c }} <i class="far fa-times-circle"></i></li>
                                                        @else
                                                            <li>{{ $soal->c }}</li>
                                                        @endif
                                                        @if ($jawaban->jawaban == 'D')
                                                            <li class="text-danger">{{ $soal->d }} <i class="far fa-times-circle"></i></li>
                                                        @else
                                                            <li>{{ $soal->d }}</li>
                                                        @endif
                                                    @elseif($soal->kunci_jawaban == 'C') 
                                                        @if ($jawaban->jawaban == 'A')
                                                            <li class="text-danger">{{ $soal->a }} <i class="far fa-times-circle"></i></li>
                                                        @else
                                                            <li>{{ $soal->a }}</li>
                                                        @endif
                                                        @if ($jawaban->jawaban == 'B')
                                                            <li class="text-danger">{{ $soal->b }} <i class="far fa-times-circle"></i></li>
                                                        @else
                                                            <li>{{ $soal->b }}</li>
                                                        @endif
                                                        <li class="text-success">{{ $soal->c }} <i class="far fa-check-circle"></i></li>
                                                        @if ($jawaban->jawaban == 'D')
                                                            <li class="text-danger">{{ $soal->d }} <i class="far fa-times-circle"></i></li>
                                                        @else
                                                            <li>{{ $soal->d }}</li>
                                                        @endif
                                                    @elseif($soal->kunci_jawaban == 'D')
                                                        @if ($jawaban->jawaban == 'A')
                                                            <li class="text-danger">{{ $soal->a }} <i class="far fa-times-circle"></i></li>
                                                        @else
                                                            <li>{{ $soal->a }}</li>
                                                        @endif 
                                                        @if ($jawaban->jawaban == 'B')
                                                            <li class="text-danger">{{ $soal->b }} <i class="far fa-times-circle"></i></li>
                                                        @else
                                                            <li>{{ $soal->b }}</li>
                                                        @endif
                                                        @if ($jawaban->jawaban == 'C')
                                                            <li class="text-danger">{{ $soal->c }} <i class="far fa-times-circle"></i></li>
                                                        @else
                                                            <li>{{ $soal->c }}</li>
                                                        @endif
                                                        <li class="text-success">{{ $soal->d }} <i class="far fa-check-circle"></i></li>
                                                    @else
                                                        <li>{{ $soal->a }}</li>
                                                        <li>{{ $soal->b }}</li>
                                                        <li>{{ $soal->c }}</li>
                                                        <li>{{ $soal->d }}</li>
                                                    @endif
                                                @else
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
                                                @endif
                                            </ol>
                                            @if ($soal->pembahasan != null)
                                                <div>
                                                    <strong>Pembahasan</strong>
                                                    <p>{{ $soal->pembahasan }}</p>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($soal->kunci_jawaban == $jawaban->jawaban)
                                                <span class="badge badge-pill badge-success">Benar</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Salah</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        if($soal->kunci_jawaban == $jawaban->jawaban){
                                            $jawabanBenar+=1;
                                        }
                                    @endphp
                                @endforeach
                                @php
                                    $jumlahSoal = count($quiz);

                                    $skorTotal = round($jawabanBenar/$jumlahSoal * 100, 0);
                                @endphp
                                <tr>
                                    <td colspan="2">Jawaban Benar</td>
                                    <td class="text-center"><strong>{{ $hasil->jawaban_benar }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Jawaban Salah</td>
                                    <td class="text-center"><strong>{{ $hasil->jawaban_salah }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Jawaban Kosong</td>
                                    <td class="text-center"><strong>{{ $hasil->jawaban_kosong }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Jumlah Soal</td>
                                    <td class="text-center"><strong>{{ $jumlahSoal }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Skor Total</td>
                                    <td class="text-center"><strong>{{ $hasil->nilai }}%</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('peserta.kelasku.quiz.index', [$kelas->id]) }}" class="btn btn-block btn-sm btn-secondary">Kembali</a>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/forms/theme-checkbox-radio.css') }}">
    <style>
        .btn-light { border-color: transparent; }
    </style>
@endpush

@push('scripts')
    <script>
        var storageQuizID = localStorage.getItem('Quiz_ID');
        var storageMenit = localStorage.getItem('Menit');
        var storageDetik = localStorage.getItem('Detik');
        var quiz_id = document.getElementById("quiz_id").value;
        if(storageQuizID == quiz_id){
            localStorage.clear();
        }
    </script>
@endpush