@extends('admin_dashboard.layouts.main')
@section('title')
    Edit Galeri | Sibakat
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
                <form action="{{ route('galeri.update', [$galeri->id]) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_foto">Nama Foto</label>
                        <input type="text" class="form-control" name="nama_foto" id="nama_foto" placeholder="Nama Foto" value="{{ old('nama_foto', $galeri->nama_foto) }}">
                    </div>
                    <div class="form-group">
                        <label for="photo_path">Foto</label><br>
                        <div class="custom-file mb-4">
                            <input type="file" class="custom-file-input" id="photo_path" name="photo_path" accept="image/*">
                            <label class="custom-file-label" for="photo_path">Pilih Gambar</label>
                        </div>
                        <div class="d-flex justify-content-center">
                            @if ($galeri->photo_path != null)
                                <img class="rounded img-fluid" src="{{ Storage::url($galeri->photo_path) }}" alt="foto" id="preview" width="400px" height="300px">
                            @else
                                <img class="rounded img-fluid" src="{{ asset('admin_dashboard/assets/img/400x300.jpg') }}" alt="foto" id="preview" width="400px" height="300px">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="publish">Publikasi?</label>
                        <div class="n-chk">
                            <label class="new-control new-radio radio-primary">
                                <input type="radio" class="new-control-input" name="publish" value="Ya" {{ old('publish', $galeri->publish) == 'Ya'? 'checked' : '' }} required>
                                <span class="new-control-indicator"></span>Ya
                            </label>
                            <label class="new-control new-radio radio-primary">
                                <input type="radio" class="new-control-input" name="publish" value="Tidak" {{ old('publish', $galeri->publish) == 'Tidak'? 'checked' : '' }} required>
                                <span class="new-control-indicator"></span>Tidak
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('galeri.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/forms/theme-checkbox-radio.css') }}">
@endpush

@push('scripts')
    <script>
        $('#photo_path').on('change',function(e){
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        })
        photo_path.onchange = evt => {
            const [file] = photo_path.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush