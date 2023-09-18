@extends('admin_dashboard.layouts.main')
@section('title')
    Testimoni | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.peserta.kelasku.includes.navbar')
    <div class="row layout-top-spacing">
            
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
            <div class="widget-content-area br-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div id="show-testimoni">
                    <button class="btn btn-sm btn-secondary shadow-none mb-2" type="button" onclick="editTestimoni()">Edit Testimoni</button>
                    <div class="row">
                        <div class="col-xl-12 mx-auto">
                            <blockquote class="blockquote">
                                @for ($i = 0; $i < $testimoni->rating; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="orange" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> 
                                @endfor
                                <br>
                                <p class="d-inline">{{ $testimoni->deskripsi }}</p>
                                <small>{{ Auth::user()->nama }}</small>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div id="edit-testimoni" style="display:none">
                    <form action="{{ route('peserta.kelasku.testimoni.update', [$kelas->id, Auth::user()->id]) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <div class="custom-progress progress-up" style="width: 100%">
                                <div class="range-count">
                                    <span class="range-count-number" data-rangecountnumber="0">{{ $testimoni->rating }}</span> 
                                    <span class="range-count-unit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="orange" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    </span>
                                </div>
                                <input type="range" min="0" max="5" name="rating" class="custom-range progress-range-counter" value="{{ old('rating', $testimoni->rating) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control max-length" maxlength="50" required>{{ old('deskripsi', $testimoni->deskripsi) }}</textarea>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-sm btn-secondary shadow-none" type="button" onclick="editTestimoni()">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="http://localhost:8000/admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link href="assets/css/elements/custom-typography.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/bootstrap-range-Slider/bootstrap-slider.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js') }}"></script>
    <script>
        $('textarea.max-length').maxlength({
            alwaysShow: true,
            threshold: 10,
            warningClass: "badge badge-success",
            limitReachedClass: "badge badge-warning"
        });
    </script>
    <script>
        function editTestimoni() {
            var showTestimoni = document.getElementById("show-testimoni");
            var editTestimoni = document.getElementById("edit-testimoni");
            if (showTestimoni.style.display === "none") {
                showTestimoni.style.display = "block";
                editTestimoni.style.display = "none";
            } else {
                showTestimoni.style.display = "none";
                editTestimoni.style.display = "block";
            }
        }
    </script>
@endpush