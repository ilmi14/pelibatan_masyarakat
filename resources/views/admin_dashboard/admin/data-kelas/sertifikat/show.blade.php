@extends('admin_dashboard.layouts.main')
@section('title')
    Sertifikat Peserta | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.admin.data-kelas.includes.navbar')

    <div class="row layout-top-spacing">
        
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">

            <div class="widget-content-area br-4 mb-3">
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

                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td style="width: 12%">Nama</td>
                                <td style="width: 1%">:</td>
                                <td>{{ $registrasiKelas->user->nama }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Telepon</td>
                                <td>:</td>
                                <td>{{ $registrasiKelas->user->nomor_telepon }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $registrasiKelas->user->email }}</td>
                            </tr>
                        </tbody>
                    </table>  
                </div>
                <a href="{{ route('data-kelas.sertifikat.index', [$kelas->id]) }}" class="btn btn-secondary">Kembali</a>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h6>Presensi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 2%">No.</th>
                                    <th style="width: 49%">Nama Presensi</th>
                                    <th style="width: 49%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($presensi as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Carbon\Carbon::parse($p->tanggal_mulai)->format('j F Y') }}</td>
                                        @if ($p->status!=null)
                                            @if ($p->status == "Hadir")
                                                <td><span class="badge badge-success">{{ $p->status }}</span></td>
                                            @else
                                                <td><span class="badge badge-warning">{{ $p->status }}</span></td>
                                            @endif
                                        @elseif(Carbon\Carbon::now()->format('j F Y') <= Carbon\Carbon::parse($p->tanggal_berakhir)->format('j F Y'))
                                            <td><span class="badge badge-warning">Belum Mengisi</span></td>
                                        @else
                                            <td><span class="badge badge-danger">Tidak Hadir</span></td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data masih kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h6>Quiz</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 2%">No.</th>
                                    <th style="width: 49%">Nama Quiz</th>
                                    <th style="width: 49%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($quiz as $q)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $q->nama_quiz }}</td>
                                        @if ($q->nilai!=null)
                                            <td><span class="badge badge-success">Sudah Mengerjakan</span></td>
                                        @else
                                            <td><span class="badge badge-danger">Belum Mengerjakan</span></td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data masih kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
            
            <div class="card mb-3">
                <div class="card-header">
                    <h6>Tugas</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 2%">No.</th>
                                    <th style="width: 49%">Nama Tugas</th>
                                    <th style="width: 49%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tugas as $t)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $t->nama_tugas }}</td>
                                        @if ($t->tugas_id!=null)
                                            <td><span class="badge badge-success">Sudah Mengerjakan</span></td>
                                        @else
                                            <td><span class="badge badge-danger">Belum Mengerjakan</span></td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data masih kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>

            <div class="widget-content-area">
                <form action="{{ route('data-kelas.sertifikat.update', [$kelas->id, $user_id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="catatan_sertifikat">Catatan</label>
                                <textarea class="form-control" id="catatan_sertifikat" name="catatan_sertifikat" rows="3">{{ old('catatan_sertifikat', $registrasiKelas->catatan_sertifikat) }}</textarea>
                                <small>Catatan wajib diisi jika sertifikat tidak terbit</small>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label for="sertifikat">Sertifikat</label>
                                <select class="form-control selectpicker" name="sertifikat" required>
                                    <option value="Terbit" {{ ($registrasiKelas->sertifikat == 'Terbit') ? 'selected': '' }}>Terbit</option>
                                    <option value="Tidak Terbit" {{ ($registrasiKelas->sertifikat == 'Tidak Terbit') ? 'selected': '' }}>Tidak Terbit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 d-flex align-items-center mt-3">
                            <button class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection

@push('modal')

@endpush

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script>
        $(".selectpicker").selectpicker({
            "title": "Pilih Menu"
        }).selectpicker("render");
    </script>
@endpush