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
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="">
                                        <span class="small">
                                            <strong>{{ $kelas->status }}</strong>
                                        </span>
                                        <br>
                                        <p class="mb-0 mt-1">{{ $kelas->nama_kelas }}</p>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('tutor.kelasku.home.index', [$kelas->id]) }}" class="btn btn-sm btn-info">
                                            <div class="d-flex">
                                                <span class="">Lihat Kelas</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-body">
                                <p class="text-center">Tidak ada kelas</p>
                            </div>
                        </div>
                    @endforelse
                    @if(count($kelasku)>3)
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('tutor.kelasku.index') }}">Selengkapnya</a>
                        </div>
                    @endif
                </div>
            </div>
        </div> --}}

        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
            <div class="widget-content-area br-4">
                <div class="widget-one">
                    <h6>Dashboard</h6>
                    <form action="{{ url('tutor/dashboard') }}" method="GET" autocomplete="off">
                        {{-- <div class="input-group input-group-sm my-2"> --}}
                            <div class="row">
                                <div class="col-sm-4">
                                    <select class="form-control select2" id="sk" name="kelas" required>
                                        <option value="" hidden>Pilih Kelas</option>
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
                                        <option value="" hidden>Pilih Tahun</option>
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
                                    <a href="{{ url('/tutor/dashboard') }}" class="btn btn-warning btn-block d-flex align-items-center justify-content-center">
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
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Peserta</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($peserta) }}</div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </div>
                        </div>
                    </blockquote>
                </div>
                <div class="col-sm-3 layout-spacing">
                    <blockquote class="blockquote">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Laki-laki</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($lakilaki) }}</div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </div>
                        </div>
                    </blockquote>
                </div>
                <div class="col-sm-3 layout-spacing">
                    <blockquote class="blockquote">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Perempuan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($perempuan) }}</div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </div>
                        </div>
                    </blockquote>
                </div>
                <div class="col-sm-3 layout-spacing">
                    <blockquote class="blockquote">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Mengajar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($mengajar) }}</div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
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
                                            <a href="{{ route('tutor.kelasku.presensi.index', [$p->kelas_id]) }}" class="btn btn-sm btn-success">
                                                <div class="d-flex">
                                                    <span class="">Sudah Mengisi</span>
                                                </div>
                                            </a>
                                        @else
                                            <a href="{{ route('tutor.kelasku.presensi.index', [$p->kelas_id]) }}" class="btn btn-sm btn-warning">
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
                        <div class="card">
                            <div class="card-body">
                                <p class="text-center">Tidak ada Presensi</p>
                            </div>
                        </div>
                    @endforelse
                    @if($cariKelas!=null && count($presensi)>=3)
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('tutor.kelasku.presensi.index', [$cariKelas->id]) }}">Selengkapnya</a>
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
                                                <strong>{{ $t->kelas->nama_kelas }}</strong>
                                            </span>
                                            <br>
                                        @endif
                                        <p class="mb-0 mt-1">{{ $t->nama_tugas }}</p>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('tutor.kelasku.tugas.show', [$t->kelas_id, $t->id]) }}" class="btn btn-sm btn-info">
                                            <div class="d-flex">
                                                <span class="">Lihat Tugas</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-body">
                                <p class="text-center">Tidak ada Tugas</p>
                            </div>
                        </div>
                    @endforelse
                    @if($cariKelas!=null && count($tugas)>=3)
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('tutor.kelasku.tugas.index', [$cariKelas->id]) }}">Selengkapnya</a>
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
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="">
                                        @if ($cariKelas==null) 
                                            <span class="small">
                                                <strong>{{ $q->kelas->nama_kelas }}</strong>
                                            </span>
                                            <br>
                                        @endif
                                        <p class="mb-0 mt-1">{{ $q->nama_quiz }}</p>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('tutor.kelasku.quiz.jawaban.index', [$q->kelas_id, $q->id]) }}" class="btn btn-sm btn-info">
                                            <div class="d-flex">
                                                <span class="">Lihat Jawaban</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-body">
                                <p class="text-center">Tidak ada kelas</p>
                            </div>
                        </div>
                    @endforelse
                    @if($cariKelas!=null && count($quiz)>=3)
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('tutor.kelasku.quiz.index', [$cariKelas->id]) }}">Selengkapnya</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link href="{{ asset('admin_dashboard/assets/css/components/timeline/custom-timeline.css') }}" rel="stylesheet" type="text/css" />
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