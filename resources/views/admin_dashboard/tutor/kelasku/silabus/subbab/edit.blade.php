@extends('admin_dashboard.layouts.main')
@section('title')
    Edit Silabus Subbab | Sibakat
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
                <form id="form" action="{{ route('tutor.kelasku.silabus.detail.update', [$kelas->id, $bab_id, $silabusSubbab->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_subbab">Nama Subbab</label>
                        <input class="form-control" id="nama_subbab" name="nama_subbab" value="{{ $silabusSubbab->nama_subbab }}" autocomplete="off" required>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tutor.kelasku.silabus.detail.index', [$kelas->id, $bab_id]) }}" class="btn btn-sm btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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

@endpush