@extends('admin_dashboard.layouts.main')
@section('title')
    Edit Kelas | Sibakat
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
                <form action="{{ route('kelas.update', $kelas->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="banner">Banner</label><br>
                        <div class="custom-file mb-4">
                            <input type="file" class="custom-file-input" id="banner" name="banner" accept="image/*">
                            <label class="custom-file-label" for="banner">Pilih Gambar</label>
                        </div>
                        <div class="d-flex justify-content-center">
                            @if ($kelas->banner != null)
                                <img class="rounded img-fluid" src="{{ Storage::url($kelas->banner) }}" alt="foto" id="preview" width="400px" height="300px">
                            @else
                                <img class="rounded img-fluid" src="{{ asset('admin_dashboard/assets/img/400x300.jpg') }}" alt="foto" id="preview" width="400px" height="300px">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" value="{{ preg_replace('~\\s+\\S+$~', "", $kelas->nama_kelas) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pendaftaran">Tanggal Pendaftaran</label>
                        <input id="tanggal_pendaftaran" name="tanggal_pendaftaran" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Pilih Tanggal Pendaftaran.." value="{{ $kelas->pendaftaran_buka }} to {{ $kelas->pendaftaran_tutup }}" required>
                    </div>
                    <div class="form-group">
                        <label for="periode_kelas">Periode Belajar</label>
                        <input id="periode_kelas" name="periode_kelas" class="form-control flatpickr flatpickr-input active" type="text" value="{{ $kelas->tanggal_mulai }} to {{ $kelas->tanggal_berakhir }}" placeholder="Pilih Periode Belajar..">
                    </div>
                    <div class="form-group">
                        <label for="persyaratan">persyaratan Kelas</label>
                        <textarea name="persyaratan" class="textarea tinymce" id="editor1" rows="10">
                            {!! $kelas->persyaratan !!}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Kelas</label>
                        <textarea name="deskripsi" class="textarea tinymce" id="editor2" rows="10">
                            {!! $kelas->deskripsi !!}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="tutor">Tutor</label>
                        <select class="placeholder form-control" name="tutor_id">
                            <option value="">Pilih Tutor...</option>
                            @foreach ($tutor as $tutor)
                                <option value="{{ $tutor->id }}" {{ ($tutor->id == $kelas->tutor_id) ? 'selected': '' }}>{{ $tutor->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control selectpicker" name="status">
                            <option value="Pendaftaran" {{ ($kelas->status == 'Pendaftaran') ? 'selected': '' }}>Pendaftaran</option>
                            <option value="Kegiatan Berlangsung" {{ ($kelas->status == 'Kegiatan Berlangsung') ? 'selected': '' }}>Kegiatan Berlangsung</option>
                            <option value="Selesai" {{ ($kelas->status == 'Selesai') ? 'selected': '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Sasaran">Sasaran</label>
                        <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-primary">
                                <input type="checkbox" name="TK_PAUD" class="new-control-input" value="1" {{ ($kelas->kelasKategori->TK_PAUD == '1') ? 'checked' : ''}}>
                                <span class="new-control-indicator"></span>TK/PAUD
                            </label>
                        </div>
                        <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-primary">
                                <input type="checkbox" name="SD_MI" class="new-control-input" value="1" {{ ($kelas->kelasKategori->SD_MI == '1') ? 'checked' : ''}}>
                                <span class="new-control-indicator"></span>SD/MI
                            </label>
                        </div>
                        <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-primary">
                                <input type="checkbox" name="SMP_MTS" class="new-control-input" value="1" {{ ($kelas->kelasKategori->SMP_MTS == '1') ? 'checked' : ''}}>
                                <span class="new-control-indicator"></span>SMP/MTS
                            </label>
                        </div>
                        <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-primary">
                                <input type="checkbox" name="SMA_SMK_MA" class="new-control-input" value="1" {{ ($kelas->kelasKategori->SMA_SMK_MA == '1') ? 'checked' : ''}}>
                                <span class="new-control-indicator"></span>SMA/SMK/MA
                            </label>
                        </div>
                        <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-primary">
                                <input type="checkbox" name="Mahasiswa" class="new-control-input" value="1" {{ ($kelas->kelasKategori->Mahasiswa == '1') ? 'checked' : ''}}>
                                <span class="new-control-indicator"></span>Mahasiswa
                            </label>
                        </div>
                        <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-primary">
                                <input type="checkbox" name="Masyarakat_Umum" class="new-control-input" value="1" {{ ($kelas->kelasKategori->Masyarakat_Umum == '1') ? 'checked' : ''}}>
                                <span class="new-control-indicator"></span>Masyarakat Umum
                            </label>
                        </div>
                        <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
                                <input type="checkbox" name="ASN_Polri_TNI" class="new-control-input" value="1" {{ ($kelas->kelasKategori->ASN_Polri_TNI == '1') ? 'checked' : ''}}>
                            <span class="new-control-indicator"></span>ASN/Polri/TNI
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/prismjs/prism.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/editors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/prismjs/prism.js') }}"></script>
    <script>
        var f3 = flatpickr(document.getElementById('periode_kelas'), {
            mode: "range",
            // minDate: "today",
            allowInput: true,
            onReady: function(selectedDates, dateStr, instance) {
                $(instance.altInput).prop('readonly', false);
            },
        });
        var f3 = flatpickr(document.getElementById('tanggal_pendaftaran'), {
            mode: "range",
            // minDate: "today",
            allowInput: true,
            onReady: function(selectedDates, dateStr, instance) {
                $(instance.altInput).prop('readonly', false);
            },
        });
    </script>
    <script>
        $(".placeholder").select2({
            placeholder: "Pilih Tutor...",
        });
    </script>
    <script>
        $(".selectpicker").selectpicker({
            "title": "Select Options"        
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
@endpush