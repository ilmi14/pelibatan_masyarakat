@extends('admin_dashboard.layouts.main')
@section('title')
    Periksa Jawaban Peserta | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.tutor.kelasku.includes.navbar')
    
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
                                <td style="width: 12%">Nama Tugas</td>
                                <td style="width: 1%">:</td>
                                <td>{{ $tugas->nama_tugas }}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi Tugas</td>
                                <td>:</td>
                                <td>{{ $tugas->deskripsi }}</td>
                            </tr>
                            <tr>
                                <td>Nama Pengirim</td>
                                <td>:</td>
                                <td>{{ $jawabanTugas->users->nama }}</td>
                            </tr>
                            <tr>
                                <td>Batas Waktu</td>
                                <td>:</td>
                                <td>{{ \Carbon\Carbon::parse($tugas->batas_waktu)->format('j F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td>Waktu Kirim</td>
                                <td>:</td>
                                <td>{{ \Carbon\Carbon::parse($jawabanTugas->updated_at)->format('j F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>:</td>
                                @if ($jawabanTugas->updated_at <= $tugas->batas_waktu)
                                    <td><span class="badge badge-success">Tepat Waktu</span></td>
                                @else
                                    <td><span class="badge badge-danger">Terlambat</span></td>
                                @endif
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                @if ($jawabanTugas->nilai != null)
                                    <td><span class="badge badge-success">Sudah Dinilai</span></td>
                                @else
                                    <td><span class="badge badge-warning">Belum Dinilai</span></td>
                                @endif
                            </tr>
                        </tbody>
                    </table>  
                </div>
                <hr>
                <div>
                    <h6><strong>Jawaban :</strong></h6>
                    <p>{{ $jawabanTugas->jawaban }}</p>
                </div>
                <div>
                    @foreach ($jawabanTugas->uploadJawabanTugas as $fileTugas)
                        @php
                            $jawabanTugasFormat = explode('/', $fileTugas->jawaban_tugas);
                            $namaJawabanTugas = end($jawabanTugasFormat);
                        @endphp
                        <a href="{{ route('jawaban.tugas.download', [$kelas->id, $fileTugas->id]) }}"><i class="far fa-save"></i> {{ $namaJawabanTugas }}</a><br>
                    @endforeach
                </div>
            </div>

            <div class="widget-content-area br-4">
                <form action="{{ route('tutor.kelasku.tugas.periksa-tugas.update', [$kelas->id, $tugas->id, $jawabanTugas->id]) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="catatan">Catatan<sup>(Opsional)</sup></label>
                                <textarea class="form-control" name="catatan" id="catatan" rows="3" placeholder="Catatan untuk peserta (opsional)">{{ $jawabanTugas->catatan }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nilai">Nilai</label>
                                <input id="nilai" type="text" name="nilai" class="form-control" onchange="changeHandler(this)" onkeypress="return isNumber(event)" value="{{ $jawabanTugas->nilai }}" min="0" max="3" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tutor.kelasku.tugas.show', [$kelas->id, $tugas->id]) }}" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
@endpush

@push('scripts')
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
    <script>
        function changeHandler(val){
            if (Number(val.value) > 100){
                val.value = 100
            }
        }
    </script>
@endpush