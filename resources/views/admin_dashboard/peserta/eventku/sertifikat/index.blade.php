<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/> --}}
    <link rel="stylesheet" href="{{ asset('sertifikat-page/bootstrap/css/bootstrap.min.css') }}"/>
    {{-- <link rel="stylesheet" href="{{ asset('admin_dashboard/plugins/fancybox/fancybox.css') }}"/> --}}
    <style type="text/css">
        html, body{
            height: 100%;
        }
    </style>
    <title>Sertifikat | Sibakat</title>
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('admin_dashboard/assets/img/favicon.ico') }}"/> --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin_dashboard/assets/img/favicon-32x32.png') }}">
  </head>
  <body>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-sm-6">
                <img src="{{ asset('admin_dashboard/assets/img/Graduation-pana.png') }}" class="img-fluid d-flex justify-content-center" alt="">
            </div>
            <div class="col-sm-6">
                <div class="container">
                    <h2 class="text-center">Selamat</h2>
                    <p class="text-center">Akhirnya kamu sudah bisa mendapatkan sertifikat dari kegiatan <strong>{{ $event->nama_event }}</strong>. silahkan unduh sertifikat dibawah ini</p>
                    <div class="mb-1 d-flex justify-content-center">
                        {{-- <a data-fancybox data-type="pdf" href="{{ route('peserta.eventku.sertifikat.download', [$event->id]) }}" class="btn btn-primary">
                            Unduh Sertifikat
                        </a> --}}
                        <a href="{{ route('peserta.eventku.sertifikat.download', [$event->id]) }}" class="btn btn-primary">
                            Unduh Sertifikat
                        </a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('peserta.eventku.deskripsi.index', [$event->id]) }}" class="btn btn-secondary">Kembali ke dashboard</a>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script> --}}
    <script src="{{ asset('sertifikat-page/jquery/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('sertifikat-page/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('admin_dashboard/plugins/fancybox/fancybox.umd.js') }}"></script> --}}
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
  </body>
</html>