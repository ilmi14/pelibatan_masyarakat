@extends('admin_dashboard.layouts.main')
@section('title')
    Edit Tugas | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.tutor.kelasku.includes.navbar')
    
    <div class="row layout-top-spacing">
        
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">

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
                <form action="{{ route('tutor.kelasku.tugas.update', [$kelas->id, $tugas->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nama_tugas">Nama Tugas</label>
                        <input type="text" class="form-control" id="nama_tugas" name="nama_tugas" placeholder="Nama Tugas" value="{{ old('nama_tugas', $tugas->nama_tugas) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="batas_waktu">Batas Waktu</label>
                        <input id="dateTimeFlatpickr" name="batas_waktu" value="{{ old('batas_waktu', $tugas->batas_waktu) }}" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Pilih Waktu.." required>
                    </div>
                    <div class="form-group">
                        @foreach ($tugas->uploadTugas as $fileTugas)
                            @php
                                $tugasFormat = explode('/', $fileTugas->tugas);
                                $namaTugas = end($tugasFormat);
                            @endphp
                            <a href="{{ route('tugas.download', [$kelas->id, $fileTugas->id]) }}"><i class="far fa-save"></i> {{ $namaTugas }}</a><br>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <div class="custom-file-container" data-upload-id="mySecondImage">
                            <label>Upload File Tugas <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                            <label class="custom-file-container__custom-file" >
                                <input type="file" name="tugas[]" class="custom-file-container__custom-file__custom-file-input" multiple>
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                            </label>
                            <small id="uploadHelp" class="form-text text-muted">Jika anda mengupload file baru maka akan menghapus data yang sebelumnya yang sudah di upload</small>
                            <div class="custom-file-container__image-preview"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tutor.kelasku.tugas.index', [$kelas->id]) }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link href="{{ asset('admin_dashboard/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <style>
        .btn-light { border-color: transparent; }
    </style>
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