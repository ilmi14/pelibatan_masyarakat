<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>@yield('title')</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin_dashboard/assets/img/favicon-32x32.png') }}">
    
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landing_page/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('landing_page/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_page/assets/css/templatemo-digimedia-v3.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_page/assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_page/assets/css/owl.css') }}">
    <!--

TemplateMo 568 DigiMedia

https://templatemo.com/tm-568-digimedia

-->
</head>
<body>
    <!-- ***** Header Area Start ***** -->
    <div class="fixed-top">
        <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="main-nav">
                            <!-- ***** Logo Start ***** -->
                            <a href="index.html" class="logo">
                                <img src="{{ asset('landing_page/assets/images/logo.png') }}" alt="">
                            </a>
                            <!-- ***** Logo End ***** -->
                            <!-- ***** Menu Start ***** -->
                            <ul class="nav">
                                <li class="scroll-to-section">
                                    <div class="border-first-button"><a href="{{ url('/') }}">Kembali</a></div>
                                </li>
                            </ul>
                            <a class='menu-trigger'>
                                <span>Menu</span>
                            </a>
                            <!-- ***** Menu End ***** -->
                        </nav>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <!-- ***** Header Area End ***** -->

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © {{ Carbon\Carbon::now()->year }} DigiMedia Co., Ltd. All Rights Reserved.
                        <br>Design: <a href="https://templatemo.com" target="_parent" title="free css templates">TemplateMo</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('landing_page/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing_page/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('landing_page/assets/js/animation.js') }}"></script>
    <script src="{{ asset('landing_page/assets/js/imagesloaded.js') }}"></script>
    {{-- <script src="{{ asset('landing_page/assets/js/custom.js') }}"></script> --}}
</body>
</html>
