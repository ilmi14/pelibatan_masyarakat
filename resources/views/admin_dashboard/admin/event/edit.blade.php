@extends('admin_dashboard.layouts.main')
@section('title')
    Edit Event | Sibakat
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
                <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="banner">Banner</label><br>
                        <div class="custom-file mb-4">
                            <input type="file" class="custom-file-input" id="banner" name="banner" accept="image/*">
                            <label class="custom-file-label" for="banner">Pilih Gambar</label>
                        </div>
                        <div class="d-flex justify-content-center">
                            @if ($event->banner != null)
                                <img class="rounded img-fluid" src="{{ Storage::url($event->banner) }}" alt="foto" id="preview" width="400px" height="300px">
                            @else
                                <img class="rounded img-fluid" src="{{ asset('admin_dashboard/assets/img/400x300.jpg') }}" alt="foto" id="preview" width="400px" height="300px">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_event">Nama Event</label>
                        <input type="text" name="nama_event" class="form-control" id="nama_event" value="{{ old('nama_event', $event->nama_event) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori Event</label>
                        <select class="form-control selectpicker" name="kategori" required>
                            <option value="Diskusi Online" {{  old('kategori', $event->kategori) ==  "Diskusi Online" ? "selected" : ""  }}>Diskusi Online</option>
                            <option value="Seminar" {{  old('kategori', $event->kategori) ==  "Seminar" ? "selected" : ""  }}>Seminar</option>
                            <option value="Workshop" {{  old('kategori', $event->kategori) ==  "Workshop" ? "selected" : ""  }}>Workshop</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pembuat_event">Nama Pembuat Event</label>
                        <input type="text" name="pembuat_event" class="form-control" id="pembuat_event" value="{{ old('pembuat_event', $event->pembuat_event) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="periode_event">Periode Event</label>
                        <input id="periode_event" name="periode_event" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Pilih Periode Event.." value="{{ $event->tanggal_mulai }} to {{ $event->tanggal_berakhir }}" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="textarea tinymce" id="editor1" rows="10" required>
                            {!! old('deskripsi', $event->deskripsi) !!}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input id="lokasi" name="lokasi" class="form-control" type="text" placeholder="Lokasi Kegiatan" value="{{ old('lokasi', $event->lokasi) }}" required>
                        <small>Jika kegiatan dilaksakan online. formatnya adalah : "Online + link "</small>
                    </div>
                    <div class="form-group">
                        <label for="deadline_pendaftaran">Batas Waktu Pendaftaran</label>
                        <input id="deadline_pendaftaran" name="deadline_pendaftaran" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Pilih Periode Event.." value="{{ old('deadline_pendaftaran', $event->deadline_pendaftaran) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="kuota">Kuota Peserta</label>
                        <input id="kuota" type="text" name="kuota" class="form-control" onkeypress="return isNumber(event)" value="{{ old('kuota', $event->kuota) }}" required>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('event.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/prismjs/prism.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/editors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/prismjs/prism.js') }}"></script>
    <script>
        var f3 = flatpickr(document.getElementById('periode_event'), {
            mode: "range",
            minDate: "today",
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            allowInput: true,
            onReady: function(selectedDates, dateStr, instance) {
                $(instance.altInput).prop('readonly', false);
            },
        });
    </script>
    <script>
        var f3 = flatpickr(document.getElementById('deadline_pendaftaran'), {
            minDate: "today",
            allowInput: true,
            onReady: function(selectedDates, dateStr, instance) {
                $(instance.altInput).prop('readonly', false);
            },
        });
    </script>
    <script>
        $(".selectpicker").selectpicker({
            "title": "Pilih Menu..."        
        }).selectpicker("render");
    </script>
    <script type='text/javascript'> 
        tinymce.init({
            selector: 'textarea.tinymce',
            // height: 500,
            plugins: 'fullscreen lists link image media codesample table wordcount autoresize',
            menubar: false,
            toolbar: 'fullscreen bold italic underline strikethrough subscript superscript | fontsize color | blocks alignment numlist bullist outdent indent blockquote | link image media codesample table | removeformat | undo redo',
            setup: (editor) => {
                editor.ui.registry.addGroupToolbarButton('alignment', {
                    icon: 'align-left',
                    tooltip: 'Alignment',
                    items: 'alignleft aligncenter alignright alignjustify'
                });
                editor.ui.registry.addGroupToolbarButton('color', {
                    icon: 'color-levels',
                    tooltip: 'Color',
                    items: 'forecolor backcolor'
                });
            },
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
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
@endpush