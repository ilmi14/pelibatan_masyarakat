@extends('admin_dashboard.layouts.main')
@section('title')
    Buat Testimoni | Sibakat
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
                @if(session('status'))
                    <div class="alert alert-info alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('status') }}
                        </div>
                    </div>
                @endif
                <form action="{{ route('peserta.kelasku.testimoni.store', $kelas->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @if(Request::get('next') != null)
                        <input type="hidden" name="next" value="{{ Request::get('next') }}">
                    @endif
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <div class="custom-progress progress-up" style="width: 100%">
                            <div class="range-count">
                                <span class="range-count-number" data-rangecountnumber="0">0</span> 
                                <span class="range-count-unit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="orange" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                </span>
                            </div>
                            <input type="range" min="0" max="5" name="rating" class="custom-range progress-range-counter" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control max-length" maxlength="50" required>{{ old('deskripsi') }}</textarea>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        {{-- <a href="{{ route('peserta.kelasku.testimoni.index', [$kelas->id]) }}" class="btn btn-secondary">Kembali</a> --}}
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="http://localhost:8000/admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
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
@endpush