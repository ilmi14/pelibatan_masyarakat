@extends('admin_dashboard.layouts.main')
@section('title')
    Profil | Sibakat
@endsection

@section('content')
    @if (session('status') == true || session('error') == true || $errors->any() == true)
        <div class="row d-flex justify-content-center layout-top-spacing">
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
                    <h5 class="card-title">Data Profil</h5>
                    <hr>
                    <form method="post" action="{{ route('profil.update') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="foto">Foto Diri</label><br>
                            @if(Auth::user()->foto != null)
                                <img class="rounded" src="{{ Storage::url($peserta->foto) }}" alt="foto" id="preview" width="90px" height="90px">
                            @else
                                <img class="rounded" src="{{ asset('admin_dashboard/assets/img/90x90.jpg') }}" alt="foto" id="preview" width="90px" height="90px">
                            @endif
                            <input type="file" name="foto" id="foto" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="status">Status Verifikasi</label>
                            @if ($peserta->status == "Sudah Verifikasi")
                                <P><strong>Sudah Verifikasi</strong> <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2196f3" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></P>
                            @else
                                <p><strong>Belum Verifikasi</strong> <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#e7515a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            @if (Auth::user()->level == 'admin')
                                <input id="nama" type="text" name="nama" class="form-control" value="{{ $peserta->nama }}" required>
                            @else
                                @if (Auth::user()->status == 'Sudah Verifikasi')
                                    <input id="nama" type="text" name="nama" class="form-control" value="{{ $peserta->nama }}" readonly required>
                                    <small id="namaHelp" class="form-text text-muted">Nama Anda sudah terverifikasi dan tidak dapat diubah. Jika Anda merasa terdapat kesalahan dan ingin memperbaikinya, silakan hubungi kami dengan menyertakan dokumen identitas asli.</small>
                                @else
                                    <input id="nama" type="text" name="nama" class="form-control" value="{{ $peserta->nama }}" required>
                                    <small id="namaHelp" class="form-text text-muted">Jika nama Anda sudah terverifikasi maka tidak dapat diubah. Mohon isi kolom nama dengan hati-hati dan teliti.</small>
                                @endif
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="row">
                                <div class="col">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="jenis_kelamin1" value="Laki-laki" name="jenis_kelamin" class="custom-control-input" {{ (Auth::user()->jenis_kelamin == 'Laki-laki') ? 'checked': '' }} required="required">
                                        <label class="custom-control-label" for="jenis_kelamin1">Laki-laki</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="jenis_kelamin2" value="Perempuan" name="jenis_kelamin" class="custom-control-input" {{ (Auth::user()->jenis_kelamin == 'Perempuan') ? 'checked': '' }}>
                                        <label class="custom-control-label" for="jenis_kelamin2">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            @php
                                $kabupaten_kota = new App\Http\Controllers\DaerahController;
                                $kabupaten_kota = $kabupaten_kota->allCities();
                            @endphp
                            <select class="form-control select2" name="tempat_lahir" required>
                                <option value="">Pilih Menu</option>
                                @foreach ($kabupaten_kota as $kabupaten_kota)
                                    <option value="{{ $kabupaten_kota->id }}" {{ ($kabupaten_kota->id == Auth::user()->tempat_lahir) ? 'selected': '' }}>{{ $kabupaten_kota->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input id="tanggal_lahir" name="tanggal_lahir" class="form-control flatpickr flatpickr-input active" type="text" value="{{ Auth::user()->tanggal_lahir }}" placeholder="Pilih Tanggal" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <input id="nomor_telepon" type="text" name="nomor_telepon" class="form-control" onkeypress="return isNumber(event)" value="{{ $peserta->nomor_telepon }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" placeholder="email@domain.com" value="{{ $peserta->email }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tipe_anggota">Tipe Anggota</label>
                            <select class="form-control selectpicker" name="tipe_anggota" required>
                                <option value="TK/PAUD" {{ (Auth::user()->tipe_anggota == 'TK/PAUD') ? 'selected': '' }}>TK/PAUD</option>
                                <option value="SD/MI" {{ (Auth::user()->tipe_anggota == 'SD/MI') ? 'selected': '' }}>SD/MI</option>
                                <option value="SMP/MTS" {{ (Auth::user()->tipe_anggota == 'SMP/MTS') ? 'selected': '' }}>SMP/MTS</option>
                                <option value="SMA/SMK/MA" {{ (Auth::user()->tipe_anggota == 'SMA/SMK/MA') ? 'selected': '' }}>SMA/SMK/MA</option>
                                <option value="Mahasiswa" {{ (Auth::user()->tipe_anggota == 'Mahasiswa') ? 'selected': '' }}>Mahasiswa</option>
                                <option value="Masyarakat Umum" {{ (Auth::user()->tipe_anggota == 'Masyarakat Umum') ? 'selected': '' }}>Masyarakat Umum</option>
                                <option value="ASN/Polri/TNI" {{ (Auth::user()->tipe_anggota == 'ASN/Polri/TNI') ? 'selected': '' }}>ASN/Polri/TNI</option>
                            </select>
                        </div>
                        <hr>
                        <h5 class="card-title">Alamat</h5>
                        <hr>
                        @if (Auth::user()->provinsi != null && Auth::user()->kabupaten_kota != null && Auth::user()->kecamatan != null && Auth::user()->desa_kelurahan != null)
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                @php
                                    $daerah = new App\Http\Controllers\DaerahController;
                                    $provinsi = $daerah->provinces();
                                    $kota_kabupaten = Indonesia::findProvince(Auth::user()->provinsi, ['cities'])->cities;
                                    $kecamatan = Indonesia::findCity(Auth::user()->kabupaten_kota, ['districts'])->districts;
                                    $desa_kelurahan = Indonesia::findDistrict(Auth::user()->kecamatan, ['villages'])->villages;
                                @endphp
                                <select class="form-control" name="provinsi" id="provinsi" required>
                                    <option value="" hidden>Pilih Menu</option>
                                    @foreach ($provinsi as $provinsi)
                                        <option value="{{ $provinsi->id }}" {{ Auth::user()->provinsi == $provinsi->id ? 'selected' : ''}}>{{ $provinsi->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kabupaten_kota">Kabupaten/Kota</label>
                                <select class="form-control" name="kabupaten_kota" id="kabupaten_kota" required>
                                    @foreach ($kota_kabupaten as $kota_kabupaten)
                                        <option value="{{ $kota_kabupaten->id }}" {{ Auth::user()->kabupaten_kota == $kota_kabupaten->id ? 'selected' : ''}}>{{ $kota_kabupaten->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control" name="kecamatan" id="kecamatan" required>
                                    @foreach ($kecamatan as $kecamatan)
                                        <option value="{{ $kecamatan->id }}" {{ Auth::user()->kecamatan == $kecamatan->id ? 'selected' : ''}}>{{ $kecamatan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="desa_kelurahan">Desa/Kelurahan</label>
                                <select class="form-control" name="desa_kelurahan" id="desa_kelurahan" required>
                                    @foreach ($desa_kelurahan as $desa_kelurahan)
                                        <option value="{{ $desa_kelurahan->id }}" {{ Auth::user()->desa_kelurahan == $desa_kelurahan->id ? 'selected' : ''}}>{{ $desa_kelurahan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                @php
                                    $daerah = new App\Http\Controllers\DaerahController;
                                    $provinsi = $daerah->provinces();
                                @endphp
                                <select class="form-control" name="provinsi" id="provinsi" required>
                                    <option value="" hidden>Pilih Menu</option>
                                    @foreach ($provinsi as $provinsi)
                                        <option value="{{ $provinsi->id }}" {{ Auth::user()->provinsi == $provinsi->id ? 'selected' : ''}}>{{ $provinsi->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kabupaten_kota">Kabupaten/Kota</label>
                                <select class="form-control" name="kabupaten_kota" id="kabupaten_kota" required>
                                    <option value="" hidden>Pilih Menu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control" name="kecamatan" id="kecamatan" required>
                                    <option value="" hidden>Pilih Menu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="desa_kelurahan">Desa/Kelurahan</label>
                                <select class="form-control" name="desa_kelurahan" id="desa_kelurahan" required>
                                    <option value="" hidden>Pilih Menu</option>
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $peserta->alamat }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-3">Simpan Profil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/select2/select2.min.css') }}">
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_dashboard/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script>
        foto.onchange = evt => {
            const [file] = foto.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
    <script>
        var ss = $(".select2").select2({
            placeholder: "Pilih tempat lahir",
        });
    </script>
    <script>
        var f1 = flatpickr(document.getElementById('tanggal_lahir'), {
            // dateFormat: "d-m-Y",
            allowInput: true,
            onReady: function(selectedDates, dateStr, instance) {
                $(instance.altInput).prop('readonly', false);
            },
        });
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
    <script>
        $(".selectpicker").selectpicker({
            "title": "Pilih Menu"
        }).selectpicker("render");
    </script>
    <script>
        function onChangeSelect(url, id, name) {
            // send ajax request to get the cities of the selected province and append to the select tag
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function (data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option hidden>Pilih Menu</option>');

                    $.each(data, function (key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                    // $('.selectpicker').selectpicker('refresh');
                }
            });
        }
        $(function () {
            $('#provinsi').on('change', function () {
                onChangeSelect('{{ route("cities") }}', $(this).val(), 'kabupaten_kota');
            });
            $('#kabupaten_kota').on('change', function () {
                onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
            })
            $('#kecamatan').on('change', function () {
                onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa_kelurahan');
            })
        });
    </script>
@endpush