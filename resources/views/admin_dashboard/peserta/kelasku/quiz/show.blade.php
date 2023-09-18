<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Pengerjaan Quiz | Sibakat</title>
    <link rel="icon" type="image/x-icon" href="http://localhost:8000/admin_dashboard/assets/img/favicon.ico" />
    <link href="http://localhost:8000/admin_dashboard/assets/css/loader.css" rel="stylesheet" type="text/css">
    <script src="http://localhost:8000/admin_dashboard/assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="http://localhost:8000/admin_dashboard/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost:8000/admin_dashboard/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://localhost:8000/admin_dashboard/plugins/font-icons/fontawesome/css/regular.css">
    <link rel="stylesheet" href="http://localhost:8000/admin_dashboard/plugins/font-icons/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="http://localhost:8000/admin_dashboard/assets/css/elements/alert.css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="http://localhost:8000/admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="http://localhost:8000/admin_dashboard/assets/css/elements/alert.css">
    <link href="http://localhost:8000/admin_dashboard/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost:8000/admin_dashboard/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost:8000/admin_dashboard/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <script src="http://localhost:8000/admin_dashboard/plugins/sweetalerts/promise-polyfill.js"></script>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>
<body class="" style="padding-top: 70px">
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">
            {{-- <form class="form-inline ml-4">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit"></button>
            </form> --}}
        </header>
    </div>
    <!--  END NAVBAR -->
    
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="" id="">
        
        <div class="overlay"></div>
        <div class="search-overlay"></div>
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="" class="main-content">
            <div class="layout-px-spacing">
                <div class="layout-top-spacing">
                    <div class="alert alert-info alert-dismissible show fade">
                        <div class="alert-body">
                            {{-- <ul>
                                <li>Kerjakan soal dengan jujur!</li>
                                <li>Pilihlah salah satu jawaban yang dianggap paling benar.</li>
                                <li>Periksa dan baca soal-soal dengan teliti sebelum menjawabnya.</li>
                                <li>Dahulukan menjawab soal-soal yang anda anggap mudah.</li>
                                <li>Periksa dahulu jawaban anda sebelum mengirim jawaban.</li>
                            </ul> --}}
                            Pilihlah salah satu jawaban yang dianggap paling benar. Mohon <strong> kerjakan soal dengan jujur! </strong>
                        </div>
                    </div>
                </div>
                
                <form action="{{ route('peserta.quiz.jawaban.store', [$kelas->id, $quiz->id]) }}" method="post" id="jawabanQuiz">
                    @csrf
                    <div class="row">
                        <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12">
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
                                    @forelse ($quiz->quizSoal as $index => $soal)
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <div class="mb-3">
                                                    <input type="hidden" name="quiz_soal_id[{{ $index }}]" value="{{ $soal->id }}">
                                                    <p>{{ $index+1 . ". " . $soal->soal }}</p>
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
                                            </div>
                                            <div class="card-body">
                                                <table>
                                                    <tr>
                                                        <td><input name="jawaban[{{ $index }}]" type="radio" value="A"></td>
                                                        <td> A. </td>
                                                        <td>{{ $soal->a }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input name="jawaban[{{ $index }}]" type="radio" value="B"></td>
                                                        <td> B. </td>
                                                        <td>{{ $soal->b }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input name="jawaban[{{ $index }}]" type="radio" value="C"></td>
                                                        <td> C. </td>
                                                        <td>{{ $soal->c }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input name="jawaban[{{ $index }}]" type="radio" value="D"></td>
                                                        <td> D. </td>
                                                        <td>{{ $soal->d }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    @empty
                                        <p>Soal tidak ditemukan</p>
                                    @endforelse
                                </section>
                            </div>
                        </div>
            
                        <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12">
                            <div class="layout-spacing sticky-top" style="top: 105px;">
                                <div class="widget-content-area">
                                    <div class="table-responsive">
                                        <table class="w-70">
                                            <tbody>
                                                <tr>
                                                    <td><b>Judul Kuis</b></td>
                                                    <td>: {{ $quiz->nama_quiz }}</td>
                                                <tr>
                                                </tr>
                                                    <td><b>Tanggal Quiz</b></td>
                                                    <td>: {{ \Carbon\Carbon::parse($quiz->tanggal_quiz)->format('j F Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Jumlah Soal</b></td>
                                                    <td>: {{ count($quiz->quizSoal) }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Sisa Waktu</b></td>
                                                    <td>: <span class="badge badge-pill badge-warning"><span class="text-light" id="menit">{{ $quiz->waktu_pengerjaan }}</span><span class="text-light">:</span><span class="text-light" id="detik">00</span></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3">
                                        <button type="submit" id="btn-submit" class="btn btn-block btn-primary">Kirim Jawaban</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- CONTENT AREA -->

            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2022 <a target="_blank" href="https://designreset.com">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="http://localhost:8000/admin_dashboard/assets/js/libs/jquery-3.1.1.js"></script>
    <script src="http://localhost:8000/admin_dashboard/bootstrap/js/popper.min.js"></script>
    <script src="http://localhost:8000/admin_dashboard/bootstrap/js/bootstrap.min.js"></script>
    <script src="http://localhost:8000/admin_dashboard/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="http://localhost:8000/admin_dashboard/assets/js/app.js"></script>
    <script src="http://localhost:8000/admin_dashboard/plugins/font-icons/feather/feather.min.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });

    </script>
    <script type="text/javascript">
        feather.replace();

    </script>
    <script src="http://localhost:8000/admin_dashboard/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="http://localhost:8000/admin_dashboard/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="http://localhost:8000/admin_dashboard/plugins/sweetalerts/custom-sweetalert.js"></script>
    <script type="text/javascript">
        document.addEventListener('keydown', (e) => {
            e = e || window.event;
            // F5
            if (e.keyCode == 116) {
                e.preventDefault();
            }
            // F11
            if (e.keyCode == 122) {
                e.preventDefault();
            }
            if (e.ctrlKey) {
                var c = e.which || e.keyCode;
                // ctrl + R
                if (c == 82) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                // ctrl + F5
                if (c == 116) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }
        });

    </script>
    <script>
        $('#btn-submit').on('click', function(e) {
            e.preventDefault();
            var form = $(this).parents('form');
            Swal.fire({
                title: "Apakah kamu sudah yakin?"
                , text: "Mohon periksa lagi jawaban anda, jika anda sudah yakin silahkan klik tombol konfirmasi!"
                , type: 'warning'
                , showCancelButton: true
                , confirmButtonColor: "#3085d6"
                , confirmButtonText: "Konfirmasi"
                , cancelButtonText: 'Batalkan'
                , closeOnConfirm: false
            , }).then((result) => {
                if (result.value) {
                    if (result) form.submit();
                    localStorage.clear();
                }
            });
        });

    </script>
    <script>
        var storageMenit = localStorage.getItem('Menit');
        var storageDetik = localStorage.getItem('Detik');
        if(storageMenit != null || storageDetik != null){
            var detik = storageDetik;
            var menit = storageMenit;
        } else {
            var detik = 00;
            var menit = {{ $quiz->waktu_pengerjaan }};
        }

        function waktu() {
            if (menit == 0 && detik == 0) {
                Swal.fire({
                    title: "Peringatan"
                    , text: "Mohon maaf waktu ujian sudah habis, klik OK untuk melihat hasil ujian anda."
                    , type: "info"
                    , allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        var formSubmitting = true;
                        document.getElementById('jawabanQuiz').submit();
                        localStorage.clear();
                    }
                });
                return false;
            }

            if (detik <= 0) {
                detik = 60;
                menit -= 1;
            }
            if (menit <= -1) {
                detik = 0;
                menit += 1;
            } else {
                detik -= 1
            }

            detik = "" + detik
            menit = "" + menit
            var pad = "00"
            document.getElementById("menit").innerHTML = pad.substring(0, pad.length - menit.length) + menit;
            document.getElementById("detik").innerHTML = pad.substring(0, pad.length - detik.length) + detik;

            setTimeout("waktu()", 1000)
            localStorage.setItem('Quiz_ID', {{ $quiz->id }});
            localStorage.setItem('Menit', menit);
            localStorage.setItem('Detik', detik);
        }
        waktu();

    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>
</html>
