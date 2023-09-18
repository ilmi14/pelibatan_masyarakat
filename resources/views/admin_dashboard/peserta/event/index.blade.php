@extends('admin_dashboard.layouts.main')
@section('title')
    Event | Sibakat
@endsection

@section('content')
    <div class="row layout-top-spacing">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 mb-3">
                    <div class="card sticky-top" style="top: 100px;">
                        <div class="card-body">
                            <form action="{{ route('peserta.event.index') }}" method="GET" autocomplete="off">
                                <h4 class="mb-3">Filter</h4>
                                <div class="mb-3">
                                    <h5 class="mb-2">Urutkan</h5>
                                    @if ($sort != null)
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="sort" name="sort" value="Event Terbaru" class="custom-control-input" onchange="this.form.submit();" {{ $sort == "Event Terbaru" ? "checked" : "" }}>
                                            <label class="custom-control-label" for="sort">Event Terbaru</label>
                                        </div>
                                    @else
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="sort" name="sort" value="Event Terbaru" class="custom-control-input" onchange="this.form.submit();" checked>
                                            <label class="custom-control-label" for="sort">Event Terbaru</label>
                                        </div>
                                    @endif
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="sort2" name="sort" value="Segera Berakhir" class="custom-control-input" onchange="this.form.submit();" {{ $sort == "Segera Berakhir" ? "checked" : "" }}>
                                        <label class="custom-control-label" for="sort2">Segera Berakhir</label>
                                    </div>
                                </div>
                                <div class="input-group input-group-sm mb-4">
                                    <input type="text" class="form-control" name="search" placeholder="Pencarian" aria-label="Pencarian" value="{{ $search }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row">
                        @foreach ($events as $event)
                            <div class="col-sm-6">
                                <a href="{{ url('peserta/event/'.$event->id) }}">
                                    <div class="card h-100">
                                        @if($event->banner != null)
                                            <img src="{{ Storage::url($event->banner) }}" width="400" height="300" style="object-fit: cover" class="card-img-top" alt="...">
                                        @else
                                            <img src="{{ asset('admin_dashboard/assets/img/400x300.jpg') }}" class="card-img-top" alt="...">
                                        @endif
                                        <div class="card-body">
                                            <div>
                                                <span class="badge badge-secondary mb-3">{{ $event->kategori }}</span>
                                            </div>
                                            <h5 class="card-title">{{ $event->nama_event }}</h5>
                                            <span class="tipe">oleh: 
                                                <span class="text-muted">{{ $event->pembuat_event }}</span>
                                            </span>
                                            <div class="mt-1 mb-3 text-justify">
                                                {!! Str::limit($event->deskripsi, 150, $end='...') !!}
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end">
                                            @if (\Carbon\Carbon::now()->format('Y-m-d') <= $event->deadline_pendaftaran)
                                                <span>Batas Pendaftaran: {{ \Carbon\Carbon::parse($event->deadline_pendaftaran)->format('j F Y') }}</span>
                                            @else
                                                <span>Pendaftaran Ditutup</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    {{ $events->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_dashboard/plugins/font-icons/fontawesome/css/fontawesome.css') }}">
    <link href="{{asset('admin_dashboard/assets/css/components/cards/card.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/elements/avatar.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
@endpush

@push('scripts')

@endpush