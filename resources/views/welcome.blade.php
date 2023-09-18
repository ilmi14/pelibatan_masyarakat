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

    <title>Sibakat - Sistem Pelibatan Masyarakat</title>
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

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->
    <a target="_blank" href="https://wa.me/6289670184654?text=Assalamualaikum%0ASaya%20ingin%20bertanya%20tentang%20Kegiatan%20Pelibatan%20Masyarakat" class="float">
        <i class="fa fa-whatsapp fa-lg my-float" aria-hidden="true"></i>
    </a>
    <!-- Pre-header Starts -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-8 col-7">
                    <ul class="info">
                        <li><a href="#"><i class="fa fa-envelope"></i>arpusindramayu7@gmail.com</a></li>
                        <li><a href="#"><i class="fa fa-phone"></i>0234 - 277139</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-sm-4 col-5">
                    <ul class="social-media">
                        <li><a href="https://www.facebook.com/disarpusindramayu/"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/perpusdaimyu"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/dpa_indramayu/"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UCetO3E36sJ1Qfv_R5pAeY2w"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-header End -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{url('/')}}" class="logo">
                            <img src="{{ asset('landing_page/assets/images/logo.png') }}" alt="">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#about">Tentang Kami</a></li>
                            <li class="scroll-to-section"><a href="#services">Kelas</a></li>
                            @if (count($events)>0)
                                <li class="scroll-to-section"><a href="#event">Event</a></li>
                            @endif
                            {{-- @if (count($testimoni)>0)
                                <li class="scroll-to-section"><a href="#free-quote">Testimoni</a></li>
                            @endif
                            @if (count($tutor)>0)
                                <li class="scroll-to-section"><a href="#portfolio">Tutor</a></li>
                            @endif --}}
                            @if (count($berita)>0)
                                <li class="scroll-to-section"><a href="#blog">Berita</a></li>
                            @endif
                            @if (count($faq)>0)
                                <li class="scroll-to-section"><a href="#faq">Bantuan</a></li>
                            @endif
                            <li class="scroll-to-section"><a href="#contact">Kontak</a></li>
                            @if (Route::has('login'))
                                @auth
                                    @if (Auth::user()->level == 'admin')
                                    <li class="">
                                        <div class="border-first-button"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                                    </li>
                                    @elseif (Auth::user()->level == 'tutor')
                                    <li class="">
                                        <div class="border-first-button"><a href="{{ url('tutor/dashboard') }}">Dashboard</a></div>
                                    </li>
                                    @elseif (Auth::user()->level == 'peserta')
                                    <li class="">
                                        <div class="border-first-button"><a href="{{ url('peserta/dashboard') }}">Dashboard</a></div>
                                    </li>
                                    @endif
                                @else
                                    <li class="">
                                        <div class="border-first-button"><a href="{{ route('login') }}">Log in</a></div>
                                    </li>
                                @endauth
                            @endif
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
    <!-- ***** Header Area End ***** -->

    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6>DPA INDRAMAYU PRESENTS</h6>
                                        <h2>KELAS PELIBATAN MASYARAKAT</h2>
                                        <p>Kelas Pelibatan Masyarakat tahun ini dibuka kembali. Pilih minat dan bidang yang kamu cocok buatmu. Segera daftarkan diri kalian. Kesempatan tidak akan datang dua kali!</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-first-button scroll-to-section">
                                            <a href="#services">Lihat Kelas</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="{{ asset('landing_page/assets/images/slider-dec-v4.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about-left-image  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="{{ asset('landing_page/assets/images/about-dec-v4.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center  wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                            <div class="about-right-content">
                                <div class="section-heading">
                                    <h6>Tentang Kami</h6>
                                    <h4>Apa itu Kegiatan Pelibatan <em>Masyarakat</em></h4>
                                    <div class="line-dec"></div>
                                </div>
                                <p>Kegiatan Pelibatan Masyarakat adalah progam rutin Dinas Perpustakaan dan Arsip Indramayu dari tahun ke tahun. Berfokus dan bertujuan untuk mengembangkan literasi di Indramayu, kami hadir membuka kelas-kelas yang dapat menambah kecakapan dalam bidang literasi yang dibutuhkan oleh masyarakat.</p>
                                {{-- <div class="row">
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="skill-item first-skill-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0s">
                                            <div class="progress" data-percentage="90">
                                                <span class="progress-left">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <div class="progress-value">
                                                    <div>
                                                        90%<br>
                                                        <span>Coding</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="skill-item second-skill-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0s">
                                            <div class="progress" data-percentage="80">
                                                <span class="progress-left">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <div class="progress-value">
                                                    <div>
                                                        80%<br>
                                                        <span>Photoshop</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="skill-item third-skill-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0s">
                                            <div class="progress" data-percentage="80">
                                                <span class="progress-left">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <div class="progress-value">
                                                    <div>
                                                        80%<br>
                                                        <span>Animation</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="services" class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h6>Kelas</h6>
                        <h4>Kenapa sih Kami Harus Ikut Kelas Pelibatan <em>Masyarakat?</em></h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="naccs">
                        <div class="grid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="menu">
                                        <div class="first-thumb active">
                                            <div class="thumb">
                                                <span class="icon"><img src="{{ asset('landing_page/assets/images/service-icon-1.png') }}" style="max-width: 60px; max-height: 60px" alt=""></span>
                                                Keuntungan
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <span class="icon"><img src="{{ asset('landing_page/assets/images/service-icon-2.png') }}" style="max-width: 60px; max-height: 60px" alt=""></span>
                                                Tutor
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <span class="icon"><img src="{{ asset('landing_page/assets/images/service-icon-3.png') }}" style="max-width: 60px; max-height: 60px" alt=""></span>
                                                Durasi
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <span class="icon"><img src="{{ asset('landing_page/assets/images/service-icon-4.png') }}" style="max-width: 60px; max-height: 60px" alt=""></span>
                                                Kegiatan
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <span class="icon"><img src="{{ asset('landing_page/assets/images/service-icon-5.png') }}" style="max-width: 60px; max-height: 60px" alt=""></span>
                                                Cakupan
                                            </div>
                                        </div>
                                        <div class="last-thumb">
                                            <div class="thumb">
                                                <span class="icon"><img src="{{ asset('landing_page/assets/images/service-icon-6.png') }}" style="max-width: 60px; max-height: 60px" alt=""></span>
                                                Keunggulan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <ul class="nacc">
                                        <li class="active">
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Keuntungan Bergabung Kelas Pelibatan Masyarakat</h4>
                                                                <div class="mb-2">Kalau kalian masih penasaran akan dapat apa selama bergabung, cek poin-poin ini:</div>
                                                                <div>
                                                                    <div>&bull; Tutor unggul dan berpengalaman di bidang masing-masing.</div> 
                                                                    <div>&bull; Durasi pembelajaran 2 jam sekali dalam seminggu.</div> 
                                                                    <div>&bull; Pembelajaran intensif, komunikatif, interaktif, dan kondusif.</div>
                                                                    <div>&bull; Mendapatkan sertifikat sebagai peserta.</div> 
                                                                </div>
                                                                <div class="mt-2">Ayo! Tunggu apa lagi? Segera daftarkan diri kalian dan bergabung bersama kami.</div>

                                                                {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedr do eiusmod deis tempor incididunt ut labore et dolore kengan darwin doerski token.
                                                                    dover lipsum lorem and the others.</p>
                                                                <div class="ticks-list"><span><i class="fa fa-check"></i> Optimized Template</span> <span><i class="fa fa-check"></i> Data Info</span> <span><i class="fa fa-check"></i> SEO Analysis</span>
                                                                    <span><i class="fa fa-check"></i> Data Info</span> <span><i class="fa fa-check"></i> SEO Analysis</span> <span><i class="fa fa-check"></i> Optimized Template</span></div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedr do eiusmod deis tempor incididunt.</p> --}}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ asset('landing_page/assets/images/services-1.png') }}" style="max-height: 285px; object-fit: cover" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Tutor</h4>
                                                                <div>
                                                                    <div>1. Berpengalaman di bidang masing-masing.</div> 
                                                                    <div>2. Telah bersertifikat baik dalam bidang ilmunya atau pun pedagoginya.</div> 
                                                                    <div>3. Dedikasi dan tepat waktu.</div>
                                                                    <div>4. Ramah dan bersahabat.</div> 
                                                                    <div>5. Profesional.</div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ asset('landing_page/assets/images/services-2.png') }}" style="max-height: 285px; object-fit: cover" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Durasi Pembelajaran</h4>
                                                                <div>
                                                                    <div>1. Pertemuan satu kali dalam seminggu terjadwal.</div> 
                                                                    <div>2. Tiap pertemuan dilaksanakan selama dua jam.</div> 
                                                                    <div>3. Pertemuan dilaksanakan di ruang audiovisual DPA.</div>
                                                                    <div>4. Pertemuan dilaksanakan dengan medium ajar secara lengkap; infokus, salindia presentasi, dan papan tulis.</div> 
                                                                    <div>5. Pertemuan dilaksankan secara tatap muka (dan/atau online jika diperlukan).</div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ asset('landing_page/assets/images/services-3.png') }}" style="max-height: 285px; object-fit: cover" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Kegiatan Pembelajaran</h4>
                                                                <div>
                                                                    <div>1. Pembelajaran dilakukan secara intensif, komunikatif, interaktif, dan kondusif.</div> 
                                                                    <div>2. Pembelajaran dirancang dan dilaksanakan dengan bantuan silabus, modul ajar, dan media online.</div> 
                                                                    <div>3. Pembelajaran dilakukan secara komunikatif yang berpusat pada para peserta.</div>
                                                                    <div>4. Pembelajaran didukung dengan <i>games</i>.</div> 
                                                                    <div>5. Pembelajaran akan dilengkapi dengan tes atau tinjauan langsung pada akhir pertemuan.</div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ asset('landing_page/assets/images/services-4.png') }}" style="max-height: 285px; object-fit: contain" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Cakupan Pembelajaran</h4>
                                                                <div>
                                                                    <div>1. Secara umum tiap jelas ditujukan untuk semua masyarakat Indramayu.</div> 
                                                                    <div>2. Siswa/i SD (untuk Kelas Menari).</div> 
                                                                    <div>3. Siswa/i SD/MI sederajat (untuk Kelas Bahasa Inggris junior).</div>
                                                                    <div>4. Siswa/i SMP, SMA/K/MA, mahasiswa, dan umum (untuk Kelas Bahasa Inggris senior).</div> 
                                                                    <div>5. Siswa/i SMP, SMA/K/MA, mahasiswa, dan umum (untuk Kelas Bahasa Jepang).</div> 
                                                                    <div>6. Siswa/i SMA/K/MA, mahasiswa dan umum (untuk Kelas Menulis).</div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ asset('landing_page/assets/images/services-5.png') }}" style="max-height: 285px; object-fit: contain" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Keunggulan-Keunggulan Lain</h4>
                                                                <div>
                                                                    <div>1. Belajar di ruang ber-AC dan multimedia.</div> 
                                                                    <div>2. Jadwal belajar cocok dan ramah dengan kegiatan lain sehari-hari.</div> 
                                                                    <div>3. Pembelajaran komprehensif.</div>
                                                                    <div>4. Memperoleh long-term skill.</div> 
                                                                    <div>5. Mendapatkan sertifikat kompetensi setelah evaluasi.</div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ asset('landing_page/assets/images/services-6.jpg') }}" style="max-height: 285px; object-fit: contain" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (count($galeri)>0)
        <div id="galeri" class="our-portfolio section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="section-heading wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
                            <h6>Galeri </h6>
                            <h4>Lihat aktivitas <em>kelas</em></h4>
                            <div class="line-dec"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach ($galeri as $g1)
                                        @if ($loop->first)
                                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $loop->index }}" class="active" aria-current="true" aria-label="Slide {{ $loop->iteration }}"></button>
                                        @else
                                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $loop->index }}" aria-label="Slide {{ $loop->iteration }}"></button>
                                        @endif
                                    @endforeach
                                    {{-- <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" aria-label="Slide 6"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="6" aria-label="Slide 7"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="7" aria-label="Slide 8"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="8" aria-label="Slide 9"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="9" aria-label="Slide 10"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="10" aria-label="Slide 11"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="11" aria-label="Slide 12"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="12" aria-label="Slide 13"></button> --}}
                                </div>
                                <div class="carousel-inner">
                                    @foreach ($galeri as $g2)
                                        @if ($loop->first)
                                            <div class="carousel-item active">
                                                <img src="{{ Storage::url($g2->photo_path) }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>{{ $g2->nama_foto }}</h5>
                                                </div>
                                            </div>
                                        @else
                                            <div class="carousel-item">
                                                <img src="{{ Storage::url($g2->photo_path) }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>{{ $g2->nama_foto }}</h5>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    {{-- <div class="carousel-item active">
                                        <img src="{{ asset('landing_page/assets/images/galeri/image-1.jpeg') }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kelas Bahasa Inggris</h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('landing_page/assets/images/galeri/image-2.jpeg') }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kelas Bahasa Inggris</h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('landing_page/assets/images/galeri/image-3.jpeg') }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kelas</h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('landing_page/assets/images/galeri/image-4.jpeg') }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kelas</h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('landing_page/assets/images/galeri/image-5.jpeg') }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kelas TIK</h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('landing_page/assets/images/galeri/image-6.jpeg') }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kelas</h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('landing_page/assets/images/galeri/image-7.jpeg') }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kelas</h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('landing_page/assets/images/galeri/image-8.jpeg') }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kelas</h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('landing_page/assets/images/galeri/image-9.jpeg') }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kelas</h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('landing_page/assets/images/galeri/image-10.jpeg') }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kelas Tari Topeng slide label</h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('landing_page/assets/images/galeri/image-11.jpeg') }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kelas Tari Topeng slide label</h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('landing_page/assets/images/galeri/image-12.jpeg') }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kelas Tari Topeng slide label</h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('landing_page/assets/images/galeri/image-13.jpeg') }}" class="d-block w-100" style="height: 480px; object-fit: cover" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Ruangan TIK</h5>
                                        </div>
                                    </div> --}}
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (count($events)>0)
        <div id="event" class="our-portfolio section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="section-heading wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                            <h6>Event </h6>
                            <h4>Lihat daftar <em>event</em></h4>
                            <div class="line-dec"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach ($events as $event)
                                <div class="col-sm-3">
                                    <a href="{{ url('peserta/event/'.$event->id) }}">
                                        <div class="card h-100">
                                            @if($event->banner != null)
                                                <img src="{{ Storage::url($event->banner) }}" class="card-img-top" alt="...">
                                            @else
                                                <img src="{{ asset('admin_dashboard/assets/img/400x300.jpg') }}" class="card-img-top" alt="...">
                                            @endif
                                            <div class="card-body">
                                                <div>
                                                    <span class="badge bg-primary mb-3">{{ $event->kategori }}</span>
                                                </div>
                                                <h5 class="card-title">{{ $event->nama_event }}</h5>
                                                <span class="tipe text-muted">oleh: 
                                                    <span class="text-muted">{{ $event->pembuat_event }}</span>
                                                </span>
                                                <div class="mt-1 mb-3" style="text-align: justify">
                                                    {!! Str::limit($event->deskripsi, 150, $end='...') !!}
                                                </div>
                                            </div>
                                            <div class="card-footer d-flex justify-content-end">
                                                @if (\Carbon\Carbon::now()->format('Y-m-d') <= $event->deadline_pendaftaran)
                                                    <small class="text-secondary">Batas Pendaftaran: {{ \Carbon\Carbon::parse($event->deadline_pendaftaran)->format('j F Y') }}</small>
                                                @else
                                                    <small class="text-secondary">Pendaftaran Ditutup</small>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- <div id="free-quote" class="free-quote">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="section-heading  wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
                        <h4>Periksa Sertifikat</h4>
                        <h6>Masukkan kode unik sertifikat di kolom bawah</h6>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-2  wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
                    <form id="search" action="#" method="GET">
                        <div class="row">
                            <div class="col-lg-8 col-sm-8">
                                <fieldset>
                                    <input type="text" name="kode_sertifikat" class="" placeholder="Kode Sertifikat..." autocomplete="off" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <fieldset>
                                    <button type="submit" class="main-button">Periksa Sekarang</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    @if (count($testimoni)>0) 
        <div id="free-quote" class="free-quote">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 offset-lg-4">
                        <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
                            <h4>Apa kata mereka</h4>
                            <h6>Dengarkan cerita menarik dari peserta</h6>
                            <div class="line-dec"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.7s">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="testimoni-loop owl-carousel">
                            @forelse ($testimoni as $testimonis)
                                <div class="testimoni-card">
                                    <div class="">
                                        <p>"{{ $testimonis->deskripsi }}"</p> 
                                    </div>
                                    <hr>
                                    <div class="">
                                        <div class="row d-flex justify-content-center align-items-center">
                                            <img src="{{ Storage::url($testimonis->user->foto) }}" class="rounded-circle" alt="" style="max-width: 56px">
                                            Oleh: {{ $testimonis->user->nama }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="testimoni-card">
                                    <div class="">
                                        <p>Data Testimoni Kosong</p> 
                                    </div>
                                    <hr>
                                    <div class="">
                                        <div class="row d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('landing_page/assets/images/90x90.jpg') }}" class="rounded-circle" alt="" style="max-width: 56px">
                                            Oleh: No Name
                                        </div>
                                    </div>
                                </div>
                                
                            @endforelse
                            {{-- <div class="testimoni-card">
                                <div class="">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doers itii eiumod deis tempor incididunt ut labore.</p> 
                                </div>
                                <hr>
                                <div class="">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('landing_page/assets/images/author-post.jpg') }}" class="rounded-circle" alt="" style="max-width: 56px">
                                        By: Andrea Mentuzi
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (count($tutor)>0)
        <div id="portfolio" class="our-portfolio section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="section-heading wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                            <h6>Tutor Kelas</h6>
                            <h4>Tutor yang <em>Berpengalaman</em></h4>
                            <div class="line-dec"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="loop owl-carousel">
                            @forelse ($tutor as $tutors)
                                <div class="item">
                                    <a href="#">
                                        <div class="portfolio-item">
                                            <div class="thumb">
                                                @if($tutors->foto!=null)
                                                    <img src="{{ Storage::url($tutors->foto) }}" width="284px" height="284px" alt="">
                                                @else
                                                    @if($tutors->jenis_kelamin=="Laki-laki")
                                                        <img src="{{ asset('landing_page/assets/images/avatar-male.png') }}" width="284px" height="284px" alt="">
                                                    @elseif($tutors->jenis_kelamin=="Perempuan")
                                                        <img src="{{ asset('landing_page/assets/images/avatar-female.png') }}" width="284px" height="284px" alt="">
                                                    @else
                                                        <img src="{{ asset('landing_page/assets/images/255x255.jpg') }}" width="284px" height="284px" alt="">
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="down-content">
                                                <h4>{{ $tutors->nama }}</h4>
                                                @if ($tutors->kelas->last() != null)   
                                                    <span>{{ preg_replace('~\\s+\\S+$~', "", $tutors->kelas->last()->nama_kelas) }}</span>
                                                @else
                                                    <span>Tutor Kelas</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                
                            @endforelse
                            {{-- <div class="item">
                                <a href="#">
                                    <div class="portfolio-item">
                                        <div class="thumb">
                                            <img src="{{ asset('landing_page/assets/images/portfolio-01.jpg') }}" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Website Builder</h4>
                                            <span>Marketing</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <div class="portfolio-item">
                                        <div class="thumb">
                                            <img src="{{ asset('landing_page/assets/images/portfolio-02.jpg') }}" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Website Builder</h4>
                                            <span>Marketing</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <div class="portfolio-item">
                                        <div class="thumb">
                                            <img src="{{ asset('landing_page/assets/images/portfolio-03.jpg') }}" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Website Builder</h4>
                                            <span>Marketing</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <div class="portfolio-item">
                                        <div class="thumb">
                                            <img src="{{ asset('landing_page/assets/images/portfolio-04.jpg') }}" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Website Builder</h4>
                                            <span>Marketing</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <div class="portfolio-item">
                                        <div class="thumb">
                                            <img src="{{ asset('landing_page/assets/images/portfolio-04.jpg') }}" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Website Builder</h4>
                                            <span>Marketing</span>
                                        </div>
                                    </div>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (count($berita)>0)
        <div id="blog" class="blog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 offset-lg-4  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">
                        <div class="section-heading">
                            <h6>Berita Terbaru</h6>
                            <h4>Silahkan baca informasi dari <em>kami</em></h4>
                            <div class="line-dec"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($berita as $key => $item)
                        @if($loop->iteration == 4)
                            @break
                        @endif
                        <div class="col-lg-4 show-up wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                            <a href="{{ url('berita/'.$item->slug) }}">
                                <div class="blog-post h-100">
                                    <div class="thumb">
                                        <img height="230px" class="fit-image" src="{{ Storage::url($item->banner) }}" alt="">
                                    </div>
                                    <div class="down-content">
                                        @if ($item->kategori != null)
                                            <span class="category">{{ $item->kategori->nama_kategori }}</span>
                                        @else
                                            <span class="category">Tidak Berkategori</span>
                                        @endif
                                        <span class="date">{{ \Carbon\Carbon::parse($item->created_at)->format('j F Y') }}</span>
                                        <h4>{{ $item->judul }}</h4>
                                        <div>
                                            {!! substr($item->isi, 0, 200) !!}
                                        </div>
                                        <span class="author">
                                            {{-- <img src="{{ asset('landing_page/assets/images/author-post.jpg') }}" alt=""> --}}
                                            By: Admin
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    @if (count($berita)>3)
                        <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                            <div class="border-first-button scroll-to-section d-flex justify-content-center mt-3">
                                <a href="{{ url('berita') }}">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if (count($faq)>0)
        <div id="faq" class="faq section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                            <h6>F.A.Q</h6>
                            <h4>Pertanyaan Yang sering <em>Ditanyakan</em></h4>
                            {{-- <h4>Dika Nakon Kula <em>Jawab</em></h4> --}}
                            <div class="line-dec"></div>
                        </div>
                    </div>
                    <div class="col-lg-12 wow fadeIn" data-wow-duration="0.5s" data-wow-delay="0.25s">
                        <div class="accordion" id="accordionExample">
                            @forelse ($faq as $key => $item) 
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $key }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">
                                            {{ $item->pertanyaan }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $key }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            {{ $item->jawaban }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            Apa itu kegiatan pelibatan masyarakat?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Kegiatan Pelibatan Masyarakat merupakan kegiatan di perpustakaan untuk memfasilitasi kebutuhan masyarakat melalui penyediaan informasi yang luas (buku, internet, pelatihan) dengan melibatkan masyarakat secara aktif.
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        @if (count($faq)>0)
                            <div class="col-lg-12 wow fadeIn" data-wow-duration="0.5s" data-wow-delay="0.25s">
                                <div class="border-first-button scroll-to-section d-flex justify-content-center mt-3">
                                    <a href="{{ url('/faq') }}">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div id="contact" class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h6>Hubungi Kami</h6>
                        <h4>Lebih Dekat Dengan <em>Kami</em></h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact" action="mailto:arpusindramayu7@gmail.com?subject=Tanya Kegiatan Pelibatan Masyarakat" method="post" enctype="text/plain">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-dec">
                                    <img src="{{ asset('landing_page/assets/images/contact-dec-v3.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div id="map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15862.002000962684!2d108.3195666!3d-6.329133!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x56b333828a7c4ce8!2sDINAS%20PERPUSTAKAAN%20DAN%20ARSIP%20KABUPATEN%20INDRAMAYU!5e0!3m2!1sid!2sid!4v1654502397408!5m2!1sid!2sid" width="100%" height="636px" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="fill-form">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('landing_page/assets/images/phone-icon.png') }}" alt="">
                                                    <a href="#">0234 - 277139</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('landing_page/assets/images/email-icon.png') }}" alt="">
                                                    <a href="#">arpusindramayu7@gmail.com</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('landing_page/assets/images/location-icon.png') }}" alt="">
                                                    <a href="#">Jl. MT Haryono No. 49</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <fieldset>
                                                        <input type="name" name="nama" id="nama" placeholder="Nama" autocomplete="on" required>
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6">
                                                    <fieldset>
                                                        <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Email Anda" required="">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <textarea name="Pesan" type="text" class="form-control" id="Pesan" placeholder="Pesan" required=""></textarea>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <button type="submit" id="form-submit" class="main-button ">Send Message Now</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © {{ Carbon\Carbon::now()->year }} DigiMedia Co., Ltd. All Rights Reserved.
                        <br>Design: <a href="https://templatemo.com" target="_parent" title="free css templates">TemplateMo</a>
                        {{-- <br>Distributed By: <a href="https://themewagon.com" target="_blank" title="free css templates">ThemeWagon</a> --}}
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
    <script src="{{ asset('landing_page/assets/js/custom.js') }}"></script>

</body>
</html>
