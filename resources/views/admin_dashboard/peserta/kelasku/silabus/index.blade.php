@extends('admin_dashboard.layouts.main')
@section('title')
    Silabus | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.peserta.kelasku.includes.navbar')

    <div class="widget-content widget-content-area">
        <h5>Silabus</h5>
        <div id="toggleAccordion">

            @foreach ($silabus as $index=>$silabus)
                @if ($loop->first)
                    <div class="card">
                        <div class="card-header" id="...">
                            <section class="mb-0 mt-0">
                                <div role="menu" class="" data-toggle="collapse" data-target="#silabus{{ $index }}" aria-expanded="false" aria-controls="defaultAccordionTwo">
                                    {{ $silabus->nama_bab }}
                                </div>
                            </section>
                        </div>
                        <div id="silabus{{ $index }}" class="collapse show" aria-labelledby="..." data-parent="#toggleAccordion">
                            <div class="card-body">
                                <ol>
                                    @foreach ($silabus->subbab as $subbab)
                                        <li>{{ $subbab->nama_subbab }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header" id="...">
                            <section class="mb-0 mt-0">
                                <div role="menu" class="collapsed" data-toggle="collapse" data-target="#silabus{{ $index }}" aria-expanded="true" aria-controls="defaultAccordionOne">
                                    {{ $silabus->nama_bab }}
                                </div>
                            </section>
                        </div>
                
                        <div id="silabus{{ $index }}" class="collapse" aria-labelledby="..." data-parent="#toggleAccordion">
                            <div class="card-body">
                                <ol>
                                    @foreach ($silabus->subbab as $subbab)
                                        <li>{{ $subbab->nama_subbab }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/cards/card.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-accordions.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/assets/js/components/ui-accordions.js') }}"></script>
@endpush