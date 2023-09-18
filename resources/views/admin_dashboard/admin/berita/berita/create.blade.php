@extends('admin_dashboard.layouts.main')
@section('title')
    Buat Berita | Sibakat
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
                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="banner">Banner</label><br>
                        <div class="custom-file mb-4">
                            <input type="file" class="custom-file-input" id="banner" name="banner" accept="image/*" required>
                            <label class="custom-file-label" for="banner">Pilih Gambar</label>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img class="rounded img-fluid" src="{{ asset('admin_dashboard/assets/img/400x300.jpg') }}" alt="foto" id="preview" width="400px" height="300px">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="placeholder form-control" name="kategori_id" required>
                            <option value="">Pilih Kategori...</option>
                            @foreach ($kategoriBerita as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <small>Jika pilihan kategori berita tidak ada silahkan buat kategori terlebih dahulu</small>
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul" value="{{ old('judul') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="isi">Isi</label>
                        <textarea name="isi" class="textarea tinymce" id="editor1" rows="10" required>
                            {!! old('isi') !!}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="publish">Publikasi?</label>
                        <div class="n-chk">
                            <label class="new-control new-radio radio-primary">
                                <input type="radio" class="new-control-input" name="publish" value="Ya" {{ old('publish') == 'Ya'? 'checked' : '' }} required>
                                <span class="new-control-indicator"></span>Ya
                            </label>
                            <label class="new-control new-radio radio-primary">
                                <input type="radio" class="new-control-input" name="publish" value="Tidak" {{ old('publish') == 'Tidak'? 'checked' : '' }} required>
                                <span class="new-control-indicator"></span>Tidak
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('berita.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/prismjs/prism.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/editors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/prismjs/prism.js') }}"></script>
    <script>
        $(".placeholder").select2({
            placeholder: "Pilih Tutor...",
        });
    </script>
    <script type='text/javascript'> 
        tinymce.init({
            selector: 'textarea.tinymce',
            // height: 500,
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    </script>
    <script>
        $('#banner').on('change',function(e){
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        })
        banner.onchange = evt => {
            const [file] = banner.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush