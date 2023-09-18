@extends('admin_dashboard.layouts.main')
@section('title')
    Akun | Sibakat
@endsection

@section('content')
    @if (session('status') == true || session('error') == true || $errors->any() == true)
        <div class="row d-flex justify-content-center">
            <div class="col-lg-7">
                @if(session('status'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('status') }}
                        </div>
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <div class="row d-flex justify-content-center layout-top-spacing">
        <div class="col-lg-7 layout-spacing">
            <div class="card">
                <div class="card-body shadow-sm rounded-lg">
                    <h5 class="card-title">Ganti Username</h5>
                    <hr>
                    <form method="post" action="{{ route('akun.update') }}" autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="username">Username Baru</label>
                            <input id="username" type="text" name="username" class="form-control" value="{{ $peserta->username }}" required>
                            <small id="usernameHelp" class="form-text text-muted">Username anda akan berubah ketika menekan tombol Simpan Username.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Username</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7 layout-spacing">
            <div class="card">
                <div class="card-body shadow-sm rounded-lg">
                    <h5 class="card-title">Ganti Password</h5>
                    <hr>
                    <form method="post" action="{{ route('akun.update') }}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="password_lama">Password Lama</label>
                            <input id="password_lama" type="password" name="password_lama" placeholder="Password Lama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password_baru">Password Baru <span class="text-danger">*</span></label>
                            <input id="password_baru" type="password" name="password" placeholder="Password Baru" class="form-control" required>
                            <small id="passwordHelp" class="form-text text-muted">Gunakan minimal 8 karakter.</small>
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi_password">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input id="konfirmasi_password" type="password" name="konfirmasi_password" placeholder="Konfirmasi Password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Password</button>
                    </form>
                </div>
            </div>          
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
@endpush

@push('scripts')
    
@endpush