@extends('admin_dashboard.layouts.main')
@section('title')
    Dokumentasi | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.peserta.eventku.includes.navbar')
    
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            @if(session('status'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <div class="widget-content widget-content-area br-6">
                <div class="mb-5">
                    <h3>Foto</h3>
                    @if (count($foto)>0)
                        @foreach ($foto as $item)
                            <img class="rounded" src="{{ Storage::url($item->dokumentasi) }}" alt="foto" id="preview" width="240px" height="">
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            Belum ada foto yang diunggah oleh pengelola Event.
                        </div>
                    @endif
                    <h3>Presentasi</h3>
                    @if (count($presentasi)>0 || count($slideshare)>0)
                        @foreach ($slideshare as $ss)
                            {!! $ss->dokumentasi !!}
                        @endforeach
                        <hr>
                        @foreach ($presentasi as $present)
                            @php
                                $presentasiFormat = explode('/', $present->nama_file);
                                $namaPresentasi = end($presentasiFormat);
                            @endphp
                            <a href="{{ route('dokumentasi.download', [$event->id, $present->id]) }}"><i class="far fa-save"></i> {{ $namaPresentasi }}</a><br>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            Belum ada presentasi yang diunggah oleh pengelola Event.
                        </div>
                    @endif
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
@endpush

@push('scripts')
    
@endpush