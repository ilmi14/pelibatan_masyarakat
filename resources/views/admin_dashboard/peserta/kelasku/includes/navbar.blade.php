<div class="layout-top-spacing">
    <div class="widget-content widget-content-area simple-pills mb-3">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(4) == 'home' ? 'active' : '' }}" href="{{ route('peserta.kelasku.home.index',[$kelas->id]) }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(4) == 'silabus' ? 'active' : '' }}" href="{{ route('peserta.kelasku.silabus.index',[$kelas->id]) }}">Silabus</a>
            </li>
            @if($registrasi->status == 'Diterima' && $kelas->status == 'Kegiatan Berlangsung' || $kelas->status == 'Selesai')
                {{-- <li class="nav-item">
                    <a class="nav-link {{ Request::segment(4) == 'peserta' ? 'active' : '' }}" href="{{ route('peserta.kelasku.peserta.index',[$kelas->id]) }}">Peserta</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::segment(4) == 'forum' ? 'active' : '' }}" href="{{ route('peserta.kelasku.forum.index',[$kelas->id]) }}">Forum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::segment(4) == 'materi' ? 'active' : '' }}" href="{{ route('peserta.kelasku.materi.index',[$kelas->id]) }}">Materi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::segment(4) == 'tugas' ? 'active' : '' }}" href="{{ route('peserta.kelasku.tugas.index',[$kelas->id]) }}">Tugas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::segment(4) == 'presensi' ? 'active' : '' }}" href="{{ route('peserta.kelasku.presensi.index',[$kelas->id]) }}">Presensi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::segment(4) == 'quiz' ? 'active' : '' }}" href="{{ route('peserta.kelasku.quiz.index',[$kelas->id]) }}">Quiz</a>
                </li>
                @if ($kelas->status == 'Selesai')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(4) == 'testimoni' ? 'active' : '' }}" href="{{ route('peserta.kelasku.testimoni.index',[$kelas->id]) }}">Testimoni</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Testimoni</a>
                    </li>
                @endif
            @else
                {{-- <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Peserta</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Forum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Materi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Tugas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Presensi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Testimoni</a>
                </li>
            @endif
        </ul>
    </div>
</div>
