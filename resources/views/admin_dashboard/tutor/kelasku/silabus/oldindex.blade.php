@extends('admin_dashboard.layouts.main')
@section('title')
    Silabus | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.tutor.kelasku.includes.navbar')

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

            @if ($kelas->silabus_id != null)
                <div class="widget-content widget-content-area br-6">
                    <div id="toggleAccordion">
                        @foreach ($bab as $index=>$bab)
                            {{-- {{ $bab->subbab }} --}}
                            @if ($loop->first)
                                <div class="card">
                                    <div class="card-header" id="...">
                                        <section class="mb-0 mt-0">
                                            <div role="menu" class="" data-toggle="collapse" data-target="#silabus{{ $index }}" aria-expanded="false" aria-controls="defaultAccordionTwo">
                                                {{ $bab->nama_bab }}
                                            </div>
                                        </section>
                                    </div>
                                    <div id="silabus{{ $index }}" class="collapse show" aria-labelledby="..." data-parent="#toggleAccordion">
                                        <div class="card-body">
                                            @if($bab->subbab != null)
                                                <ol>
                                                    @foreach ($bab->subbab as $subbab)
                                                        <li>{{ $subbab->nama_subbab }}</li>
                                                    @endforeach
                                                </ol>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-header" id="...">
                                        <section class="mb-0 mt-0">
                                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#silabus{{ $index }}" aria-expanded="true" aria-controls="defaultAccordionOne">
                                                {{ $bab->nama_bab }}
                                            </div>
                                        </section>
                                    </div>
                            
                                    <div id="silabus{{ $index }}" class="collapse" aria-labelledby="..." data-parent="#toggleAccordion">
                                        <div class="card-body">
                                            @if($bab->subbab != null)
                                                <ol>
                                                    @foreach ($bab->subbab as $subbab)
                                                        <li>{{ $subbab->nama_subbab }}</li>
                                                    @endforeach
                                                </ol>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @else
                <div class="widget-content widget-content-area br-6">
                    Data tidak ditemukan
                </div>
            @endif
        </div>

    </div>
@endsection

@push('modal')

@endpush

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/select2/select2.min.css') }}">
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/cards/card.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-accordions.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/assets/js/components/ui-accordions.js') }}"></script>
    <script>
        var ss = $(".select2").select2({
            placeholder: "Pilih Silabus",
        });
    </script>
@endpush