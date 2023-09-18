@extends('admin_dashboard.layouts.main')
@section('title')
    Edit Tutor | Sibakat
@endsection

@section('content')
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
                <form action="{{ route('tutor.update', $tutor->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama', $tutor->nama) }}" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="email@example.com" value="{{ old('email', $tutor->email) }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nomor_telepon">Nomor Telepon</label>
                                <input type="text" name="nomor_telepon" class="form-control" id="nomor_telepon" placeholder="08123456789" value="{{ old('nomor_telepon', $tutor->nomor_telepon) }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" value="{{ old('username', $tutor->username) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password <sup>(Opsional)</sup></label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi_password">Konfirmasi Password <sup>(Opsional)</sup></label>
                            <input type="password" name="konfirmasi_password" class="form-control" id="konfirmasi_password">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tutor.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection