<div class="layout-top-spacing">
    <div class="widget-content widget-content-area simple-pills mb-3">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(4) == 'deskripsi' ? 'active' : '' }}" href="{{ route('data-event.deskripsi.index',[$event->id]) }}">Deskripsi</a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ Request::segment(4) == 'dokumentasi' ? 'active' : '' }}" href="{{ route('data-event.dokumentasi.index',[$event->id]) }}">Dokumentasi</a>
           </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(4) == 'peserta' ? 'active' : '' }}" href="{{ route('data-event.peserta.index',[$event->id]) }}">Peserta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(4) == 'presensi' ? 'active' : '' }}" href="{{ route('data-event.presensi.index',[$event->id]) }}">Presensi</a>
            </li>
            @if (\Carbon\Carbon::now()->format('Y-m-d') > $event->tanggal_berakhir)
                <li class="nav-item">
                    <a class="nav-link {{ Request::segment(4) == 'sertifikat' ? 'active' : '' }}" href="{{ route('data-event.sertifikat.index',[$event->id]) }}">Sertifikat</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Sertifikat</a>
                </li>
            @endif
        </ul>
    </div>
</div>