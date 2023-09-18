<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link href="{{ asset('landing_page/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #edf2f7;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center my-4">
        <a href="{{ url('/') }}"><img src="{{ asset('landing_page/assets/images/logo.png') }}" alt=""></a>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h6>Hallo!</h6>
                    <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun anda.</p>
                    <div class="d-flex justify-content-center mb-3">
                        <a class="btn btn-dark" href="{{ url('reset-password/'.$token.'') }}">Reset Password</a>
                    </div>
                    <p><strong>Perhatian</strong>, link reset password ini hanya berlaku selama 60 menit.</p>
                    <p>Jika anda tidak melakukan permintaan reset password, abaikan email ini.</p>
                    <p>Hormat Kami, <br>Sibakat</p>
                    <hr>
                    <p>Jika anda ada masalah dengan tombol "Reset Password", salin dan tempel link berikut ini ke web browser: <span style="word-break: break-all"><a href="{{ url('reset-password/'.$token.'') }}">{{ url('reset-password/'.$token.'') }}</a></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center my-4">
        <small class="text-muted">&copy; {{ Carbon\Carbon::now()->format('Y') . ' ' . env('APP_NAME')}}. All right reserved.</small>
    </div>
    <script src="{{ asset('landing_page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>