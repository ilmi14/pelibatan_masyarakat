@extends('admin_dashboard.layouts.main')
@section('title')
    Detail Tugas | Sibakat
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
                                <td style="width: 15%">Tanggal</td>
                                <td style="width: 1%">:</td>
                                <td>{{ \Carbon\Carbon::parse($tugas->created_at)->format('j F Y H:i') }}</td>
                            </tr>
                            @if ($tugas->created_at != $tugas->updated_at)
                                <tr>
                                    <td>Tanggal Diperbarui</td>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($tugas->updated_at)->format('j F Y H:i') }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Batas Waktu</td>
                                <td>:</td>
                                <td><span class="badge badge-info">{{ \Carbon\Carbon::parse($tugas->batas_waktu)->format('j F Y H:i') }}</span></td>
                            </tr>
                            <tr>
                                <td>Nama Tugas</td>
                                <td>:</td>
                                <td>{{ $tugas->nama_tugas }}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td>{{ $tugas->deskripsi }}</td>
                            </tr>
                        </tbody>
                    </table>  
                </div>
                <div>
                    @foreach ($tugas->uploadTugas as $fileTugas)
                        @php
                            $tugasFormat = explode('/', $fileTugas->tugas);
                            $namaTugas = end($tugasFormat);
                        @endphp
                        <a href="{{ route('tugas.download', [$kelas->id, $fileTugas->id]) }}"><i class="far fa-save"></i> {{ $namaTugas }}</a><br>
                    @endforeach
                </div>
                <hr>
                <a href="{{ route('data-kelas.tugas.index', [$kelas->id]) }}" class="btn btn-secondary">Kembali</a>
            </div>

            <div class="widget-content-area br-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h5 class="card-title">Belum Mengumpulkan</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-text">
                                    @if(count($jawaban) > 0)
                                        @foreach ($jawaban as $jb)
                                            @if ($jb->jawaban_id==null)
                                                <div class="row">
                                                    @if ($jb->foto != null)
                                                        <img class="rounded ml-3" src="{{ Storage::url($jb->foto) }}" width="50px" height="50px" alt="pic1">
                                                    @else
                                                        <img class="rounded ml-3" src="{{ asset('admin_dashboard/assets/img/90x90.jpg') }}" width="50px" height="50px" alt="pic1">
                                                    @endif
                                                    <div class="col">
                                                        <h6 class=""><strong>{{ $jb->nama }}</strong></h6>
                                                        <p class=""><span class="badge badge-danger">Nilai : Belum Mengumpulkan</span></p>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="d-flex justify-content-center">Yeay, Semuanya sudah mengumpulkan tugas</span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="d-flex justify-content-center">Yeay, Semuanya sudah mengumpulkan tugas</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h5 class="card-title">Sudah Mengumpulkan</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-text">
                                    @if(count($jawaban) > 0)
                                        @foreach ($jawaban as $index=>$js)
                                            @if ($js->jawaban_id!=null)
                                                <div class="row">
                                                    @if ($js->foto != null)
                                                        <img class="rounded ml-3" src="{{ Storage::url($js->foto) }}" width="50px" height="50px" alt="pic1">
                                                    @else
                                                        <img class="rounded ml-3" src="{{ asset('admin_dashboard/assets/img/90x90.jpg') }}" width="50px" height="50px" alt="pic1">
                                                    @endif
                                                    <div class="col">
                                                        <h6 class=""><strong>{{ $js->nama }}</strong></h6>
                                                        @if ($js->nilai != null)
                                                            <p class=""><span class="badge badge-success">Nilai : {{ $js->nilai }}</span></p>                                            
                                                        @else
                                                            <p class=""><span class="badge badge-warning">Nilai : Belum Dinilai</span></p>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="col">
                                                            <a href="{{ route('data-kelas.tugas.periksa-tugas.show', [$kelas->id, $tugas->id, $js->jawaban_id]) }}" class="btn btn-primary btn-round btn-sm"><i class="far fa-check-square"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="d-flex justify-content-center">Yah, semua peserta belum mengumpulkan tugas</span>
                                            @endif    
                                        @endforeach
                                    @else
                                        <span class="d-flex justify-content-center">Yah, semua peserta belum mengumpulkan tugas</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('modal')

@endpush

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link href="{{ asset('admin_dashboard/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-media_object.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.js') }}"></script>
    <script>
        var secondUpload = new FileUploadWithPreview('mySecondImage')
    </script>
    <script>
        var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            allowInput: true,
            onReady: function(selectedDates, dateStr, instance) {
                $(instance.altInput).prop('readonly', false);
            },
        });
    </script>
@endpush