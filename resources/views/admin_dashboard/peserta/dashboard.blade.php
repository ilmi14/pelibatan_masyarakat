@extends('admin_dashboard.layouts.main')
@section('title')
    Dashboard | Sibakat
@endsection

@section('content')
    <div class="row layout-top-spacing">

        {{-- <div class="col-sm-6 layout-spacing">
            <div class="widget-content-area br-4">
                <div class="widget-heading">
                    <h5>Kelasku</h5>
                </div>
                <hr>
                <div class="widget-content">
                    @forelse ($kelasku as $kelas)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="">
                                        <span class="small">
                                            <strong>{{ $kelas->kelas->status }}</strong>
                                        </span>
                                        <br>
                                        <p class="mb-0 mt-1">{{ $kelas->kelas->nama_kelas }}</p>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('peserta.kelasku.home.index', [$kelas->kelas->id]) }}" class="btn btn-sm btn-info">
                                            <div class="d-flex">
                                                <span class="">Lihat Kelas</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card mb-2">
                            <div class="card-body">
                                <p class="text-center">Tidak ada kelas</p>
                            </div>
                        </div>
                    @endforelse
                    @if(count($kelasku)>3)
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('peserta.kelasku.index') }}">Selengkapnya</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 layout-spacing">
            <div class="widget-content-area br-4">
                <div class="widget-heading">
                    <h5>Eventku</h5>
                </div>
                <hr>
                <div class="widget-content">
                    @forelse ($eventku as $event)
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="">
                                        <span class="small">
                                            @if (\Carbon\Carbon::now()->format('Y-m-d') < $event->event->tanggal_mulai)
                                                <strong>Pendaftaran Peserta</strong>
                                            @elseif(\Carbon\Carbon::now()->format('Y-m-d') > $event->event->tanggal_berakhir)
                                                <strong>Kegiatan sedang berlangsung</strong>
                                            @else
                                                <strong>Event telah berakhir</strong>
                                            @endif
                                        </span>
                                        <br>
                                        <p class="mb-0 mt-1">{{ $event->event->nama_event }}</p>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('peserta.eventku.deskripsi.index', [$event->event->id]) }}" class="btn btn-sm btn-info">
                                            <div class="d-flex">
                                                <span class="">Lihat Event</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-body">
                                <p class="text-center">Tidak ada event</p>
                            </div>
                        </div>
                    @endforelse
                    @if(count($eventku)>3)
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('peserta.eventku.index') }}">Selengkapnya</a>
                        </div>
                    @endif
                </div>
            </div>
        </div> --}}

        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
            <div class="widget-content-area br-4">
                <div class="widget-one">
                    <h6>Dashboard</h6>
                    <form action="{{ url('peserta/dashboard') }}" method="GET" autocomplete="off">
                        {{-- <div class="input-group input-group-sm my-2"> --}}
                            <div class="row">
                                <div class="col-sm-4">
                                    <select class="form-control select2" id="sk" name="kelas" required>
                                        <option value="">Pilih Kelas</option>
                                        @if ($namaKelas != null)
                                            @foreach ($namaKelas as $class)
                                                @if ($cariKelas!=null)
                                                    <option value="{{ $class }}" {{ ($class == preg_replace('~\\s+\\S+$~', "", $cariKelas->nama_kelas)) ? 'selected': '' }}>{{ $class }}</option>
                                                @else
                                                    <option value="{{ $class }}">{{ $class }}</option>                                           
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control select2" id="st" name="tahun" required>
                                        <option value="">Pilih Tahun</option>
                                        @if ($pilihTahun != null)
                                            @foreach ($pilihTahun as $tahun)
                                                @if ($cariKelas!=null)
                                                    <option value="{{ $tahun }}" {{ ($tahun == \Carbon\Carbon::parse($cariKelas->tanggal_mulai)->format('Y')) ? 'selected': '' }}>{{ $tahun }}</option>                                           
                                                @else
                                                    <option value="{{ $tahun }}">{{ $tahun }}</option>                                           
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-2 input-group-append">
                                    <button class="btn btn-primary btn-block" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                        Cari
                                    </button>
                                </div>
                                <div class="col-sm-2 input-group-append">
                                    <a href="{{ url('/peserta/dashboard') }}" class="btn btn-warning btn-block d-flex align-items-center justify-content-center">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        {{-- </div> --}}
                    </form>
                </div>
            </div>
        </div> 

        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3 layout-spacing">
                    <blockquote class="blockquote">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Hadir</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $hadir }}</div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                            </div>
                        </div>
                    </blockquote>
                </div>
                <div class="col-sm-3 layout-spacing">
                    <blockquote class="blockquote">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tidak Hadir</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tidakHadir }}</div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-x"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="18" y1="8" x2="23" y2="13"></line><line x1="23" y1="8" x2="18" y2="13"></line></svg>
                            </div>
                        </div>
                    </blockquote>
                </div>
                <div class="col-sm-3 layout-spacing">
                    <blockquote class="blockquote">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sakit</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sakit }}</div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                            </div>
                        </div>
                    </blockquote>
                </div>
                <div class="col-sm-3 layout-spacing">
                    <blockquote class="blockquote">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Izin</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $izin }}</div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            </div>
                        </div>
                    </blockquote>
                </div>
            </div>
        </div>

        <div class="col-sm-6 layout-spacing">
            <div class="widget-content-area br-4">
                <div class="widget-heading">
                    <h5>Presensi</h5>
                </div>
                <hr>
                <div class="widget-content">
                    @forelse ($presensi as $p)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="">
                                        @if ($cariKelas==null) 
                                            <span class="small">
                                                <strong>{{ $p->kelas->nama_kelas }}</strong>
                                            </span>
                                            <br>
                                        @endif
                                        <p class="mb-0 mt-1">{{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('j F Y') }}</p>
                                    </div>
                                    <div class="">
                                        @php
                                            $dataPresensi = DB::table('data_presensi')->where('presensi_id', $p->id)->where('user_id', Auth::user()->id)->first();
                                        @endphp
                                        @if ($dataPresensi!=null)
                                            <a href="{{ route('peserta.kelasku.presensi.index', [$p->kelas_id]) }}" class="btn btn-sm btn-success">
                                                <div class="d-flex">
                                                    <span class="">Sudah Mengisi</span>
                                                </div>
                                            </a>
                                        @else
                                            <a href="{{ route('peserta.kelasku.presensi.index', [$p->kelas_id]) }}" class="btn btn-sm btn-warning">
                                                <div class="d-flex">
                                                    <span class="">Isi Presensi</span>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card mb-2">
                            <div class="card-body">
                                <p class="text-center">Tidak ada Presensi</p>
                            </div>
                        </div>
                    @endforelse
                    @if($cariKelas!=null && count($presensi)>=3)
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('peserta.kelasku.presensi.index', [$cariKelas->id]) }}">Selengkapnya</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-6 layout-spacing">
            <div class="widget-content-area br-4">
                <div class="widget-heading">
                    <h5>Tugas</h5>
                </div>
                <hr>
                <div class="widget-content">
                    @forelse ($tugas as $t)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="">
                                        @if ($cariKelas==null) 
                                            <span class="small">
                                                <strong>{{ $p->kelas->nama_kelas }}</strong>
                                            </span>
                                            <br>
                                        @endif
                                        <p class="mb-0 mt-1">{{ $t->nama_tugas }}</p>
                                    </div>
                                    <div class="">
                                        @php
                                            $dataTugas = DB::table('jawaban_tugas')->where('tugas_id', $t->id)->where('users_id', Auth::user()->id)->first();
                                        @endphp
                                        @if ($dataTugas!=null)
                                            <a href="{{ route('peserta.kelasku.tugas.show', [$p->kelas_id, $t->id]) }}" class="btn btn-sm btn-success">
                                                <div class="d-flex">
                                                    <span class="">Lihat Jawaban</span>
                                                </div>
                                            </a>
                                        @else
                                            <a href="{{ route('peserta.kelasku.tugas.show', [$p->kelas_id, $t->id]) }}" class="btn btn-sm btn-warning">
                                                <div class="d-flex">
                                                    <span class="">Kirim Jawaban</span>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card mb-2">
                            <div class="card-body">
                                <p class="text-center">Tidak ada Tugas</p>
                            </div>
                        </div>
                    @endforelse
                    @if($cariKelas!=null && count($tugas)>=3)
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('peserta.kelasku.tugas.index', [$cariKelas->id]) }}">Selengkapnya</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-6 layout-spacing">
            <div class="widget-content-area br-4">
                <div class="widget-heading">
                    <h5>Quiz</h5>
                </div>
                <hr>
                <div class="widget-content">
                    @forelse ($quiz as $q)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="">
                                        @if ($cariKelas==null) 
                                            <span class="small">
                                                <strong>{{ $q->kelas->nama_kelas }}</strong>
                                            </span>
                                            <br>
                                        @endif
                                        <p class="mb-0 mt-1">{{ $q->nama_quiz . " (" . \Carbon\Carbon::parse($q->tanggal_quiz)->format('j F Y'). ")" }}</p>
                                    </div>
                                    <div class="">
                                        @php
                                            $dataQuiz = DB::table('nilai_quiz')->where('quiz_id', $q->id)->where('user_id', Auth::user()->id)->first();
                                        @endphp
                                        @if ($dataQuiz!=null)
                                            <a href="{{ route('peserta.quiz.jawaban.show', [$q->kelas_id, $q->id]) }}" class="btn btn-sm btn-success">
                                                <div class="d-flex">
                                                    <span class="">Lihat Jawaban</span>
                                                </div>
                                            </a>
                                        @else
                                            @if (\Carbon\Carbon::now()->format('Y-m-d') >= \Carbon\Carbon::parse($q->tanggal_quiz)->format('Y-m-d'))
                                                <a href="{{ route('peserta.kelasku.quiz.show', [$q->kelas_id, $q->id]) }}" class="btn btn-sm btn-warning">
                                                    <div class="d-flex">
                                                        <span class="">Isi Jawaban</span>
                                                    </div>
                                                </a>
                                            @else
                                                <button class="btn btn-sm btn-warning" disabled>
                                                    <div class="d-flex">
                                                        <span class="">Mulai Tanggal {{ \Carbon\Carbon::parse($q->tanggal_quiz)->format('j F Y') }}</span>
                                                    </div>
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card mb-2">
                            <div class="card-body">
                                <p class="text-center">Tidak ada Presensi</p>
                            </div>
                        </div>
                    @endforelse
                    @if($cariKelas!=null && count($quiz)>=3)
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('peserta.kelasku.quiz.index', [$cariKelas->id]) }}">Selengkapnya</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-6 layout-spacing">
            <div class="widget-content-area br-4">
                <div class="widget-heading">
                    <h5>Materi</h5>
                </div>
                <hr>
                <div class="widget-content">
                    @forelse ($materi as $m)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="">
                                        @if ($cariKelas==null) 
                                            <span class="small">
                                                <strong>{{ $m->kelas->nama_kelas }}</strong>
                                            </span>
                                            <br>
                                        @endif
                                        <p class="mb-0 mt-1">{{ $m->nama_materi }}</p>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('peserta.kelasku.tugas.show', [$m->kelas_id, $m->id]) }}" class="btn btn-sm btn-info">
                                            <div class="d-flex">
                                                <span class="">Lihat Materi</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card mb-2">
                            <div class="card-body">
                                <p class="text-center">Tidak ada materi</p>
                            </div>
                        </div>
                    @endforelse
                    @if($cariKelas!=null && count($materi)>=3)
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('peserta.kelasku.materi.index', [$cariKelas->id]) }}">Selengkapnya</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/select2/select2.min.css') }}">
    <style>
        .btn-light { border-color: transparent; }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/select2/select2.min.js') }}"></script>
    <script>
        var kelas = $("#sk").select2({
            placeholder: "Pilih Kelas",
        });
        var tahun = $("#st").select2({
            placeholder: "Pilih Tahun",
        });
    </script>
@endpush