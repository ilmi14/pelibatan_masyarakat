<div class="sidebar-wrapper sidebar-theme">
            
    <nav id="sidebar">
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                @if(Auth::user()->foto != null)
                    <img src="{{ Storage::url(Auth::user()->foto) }}" width="90" height="90" style="object-fit: cover" alt="avatar">
                @else
                    <img src="{{ asset('admin_dashboard/assets/img/90x90.jpg') }}" alt="avatar">
                @endif
                <h6>{{ Auth::user()->nama }}</h6>
                <p>{{ Auth::user()->level }}</p>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            @if (Auth::user()->level == 'admin')
                <li class="menu {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ url('/admin/dashboard') }}" aria-expanded="{{ Request::segment(2) == 'dashboard' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span> Dashboard</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{ Request::segment(2) == 'tutor' ? 'active' : '' }}">
                    <a href="{{ route('tutor.index') }}" aria-expanded="{{ Request::segment(2) == 'tutor' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            <span> Tutor</span>
                        </div>
                    </a>
                </li>
                <li class="menu">
                    <a href="#kelas" data-toggle="collapse" aria-expanded="{{ Request::segment(2) == 'kelas' || Request::segment(2) == 'data-kelas' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                            <span> Kelas</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ Request::segment(2) == 'kelas' || Request::segment(2) == 'data-kelas' ? 'toggle' : 'collapse' }} submenu list-unstyled" id="kelas" data-parent="#accordionExample">
                        <li class="{{ Request::segment(2) == 'kelas' ? 'active' : '' }}">
                            <a href="{{ route('kelas.index') }}"> Kelola Kelas </a>
                        </li>
                        <li class="{{ Request::segment(2) == 'data-kelas' ? 'active' : '' }}">
                            <a href="{{ Route('data-kelas.index') }}"> Data Kelas </a>
                        </li>      
                    </ul>
                </li>
                <li class="menu">
                    <a href="#event" data-toggle="collapse" aria-expanded="{{ Request::segment(2) == 'event' || Request::segment(2) == 'data-event' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                            <span> Event</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ Request::segment(2) == 'event' || Request::segment(2) == 'data-event' ? 'toggle' : 'collapse' }} submenu list-unstyled" id="event" data-parent="#accordionExample">
                        <li class="{{ Request::segment(2) == 'event' ? 'active' : '' }}">
                            <a href="{{ route('event.index') }}"> Kelola Event </a>
                        </li>
                        <li class="{{ Request::segment(2) == 'data-event' ? 'active' : '' }}">
                            <a href="{{ Route('data-event.index') }}"> Data Event </a>
                        </li>      
                    </ul>
                </li>
                {{-- <li class="menu {{ Request::segment(2) == 'silabus' ? 'active' : '' }}">
                    <a href="{{ url('/admin/silabus') }}" aria-expanded="{{ Request::segment(2) == 'silabus' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                            <span> Silabus</span>
                        </div>
                    </a>
                </li> --}}
                <li class="menu">
                    <a href="#berita" data-toggle="collapse" aria-expanded="{{ Request::segment(2) == 'berita' || Request::segment(2) == 'kategori-berita' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                            <span> Berita</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ Request::segment(2) == 'berita' || Request::segment(2) == 'kategori-berita' ? 'toggle' : 'collapse' }} submenu list-unstyled" id="berita" data-parent="#accordionExample">
                        <li class="{{ Request::segment(2) == 'berita' ? 'active' : '' }}">
                            <a href="{{ Route('berita.index') }}"> Berita </a>
                        </li>      
                        <li class="{{ Request::segment(2) == 'kategori-berita' ? 'active' : '' }}">
                            <a href="{{ route('kategori-berita.index') }}"> Kategori </a>
                        </li>
                    </ul>
                </li>
                <li class="menu {{ Request::segment(2) == 'galeri' ? 'active' : '' }}">
                    <a href="{{ url('/admin/galeri') }}" aria-expanded="{{ Request::segment(2) == 'galeri' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            <span> Galeri</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{ Request::segment(2) == 'faq' ? 'active' : '' }}">
                    <a href="{{ url('/admin/faq') }}" aria-expanded="{{ Request::segment(2) == 'faq' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                            <span> FAQ</span>
                        </div>
                    </a>
                </li>
                <li class="menu">
                    <a href="#pengaturan" data-toggle="collapse" aria-expanded="{{ Request::segment(2) == 'profil' || Request::segment(2) == 'akun' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            <span> Pengaturan</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ Request::segment(2) == 'profil' || Request::segment(2) == 'akun' ? 'toggle' : 'collapse' }} submenu list-unstyled" id="pengaturan" data-parent="#accordionExample">
                        <li class="{{ Request::segment(2) == 'profil' ? 'active' : '' }}">
                            <a href="{{ url('/admin/profil') }}"> Profil </a>
                        </li>
                        <li class="{{ Request::segment(2) == 'akun' ? 'active' : '' }}"">
                            <a href="{{ url('/admin/akun') }}"> Akun </a>
                        </li>                           
                    </ul>
                </li>
            @elseif(Auth::user()->level == 'tutor')
                <li class="menu {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ url('/tutor/dashboard') }}" aria-expanded="{{ Request::segment(2) == 'dashboard' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span> Dashboard</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{ Request::segment(2) == 'kelasku' ? 'active' : '' }}">
                    <a href="{{ url('/tutor/kelasku') }}" aria-expanded="{{ Request::segment(2) == 'kelasku' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                            <span> Kelasku</span>
                        </div>
                    </a>
                </li>
                {{-- <li class="menu {{ Request::segment(2) == 'silabus' ? 'active' : '' }}">
                    <a href="{{ url('/tutor/silabus') }}" aria-expanded="{{ Request::segment(2) == 'silabus' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                            <span> Silabus</span>
                        </div>
                    </a>
                </li> --}}
                <li class="menu">
                    <a href="#pengaturan" data-toggle="collapse" aria-expanded="{{ Request::segment(2) == 'profil' || Request::segment(2) == 'akun' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            <span> Pengaturan</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ Request::segment(2) == 'profil' || Request::segment(2) == 'akun' ? 'toggle' : 'collapse' }} submenu list-unstyled" id="pengaturan" data-parent="#accordionExample">
                        <li class="{{ Request::segment(2) == 'profil' ? 'active' : '' }}">
                            <a href="{{ url('/tutor/profil') }}"> Profil </a>
                        </li>
                        <li class="{{ Request::segment(2) == 'akun' ? 'active' : '' }}"">
                            <a href="{{ url('/tutor/akun') }}"> Akun </a>
                        </li>                           
                    </ul>
                </li>
            @else
                <li class="menu {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ url('/peserta/dashboard') }}" aria-expanded="{{ Request::segment(2) == 'dashboard' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span> Dashboard</span>
                        </div>
                    </a>
                </li>
                <li class="menu">
                    <a href="#kelas" data-toggle="collapse" aria-expanded="{{ Request::segment(2) == 'kelas' || Request::segment(2) == 'kelasku' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                            <span> Kelas</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ Request::segment(2) == 'kelas' || Request::segment(2) == 'kelasku' ? 'toggle' : 'collapse' }} submenu list-unstyled" id="kelas" data-parent="#accordionExample">
                        <li class="{{ Request::segment(2) == 'kelas' ? 'active' : '' }}">
                            <a href="{{ route('peserta.kelas.index') }}"> Pilih Kelas </a>
                        </li>
                        <li class="{{ Request::segment(2) == 'kelasku' ? 'active' : '' }}">
                            <a href="{{ route('peserta.kelasku.index') }}"> Kelasku </a>
                        </li>                           
                    </ul>
                </li>
                <li class="menu">
                    <a href="#event" data-toggle="collapse" aria-expanded="{{ Request::segment(2) == 'event' || Request::segment(2) == 'eventku' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                            <span> Event</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ Request::segment(2) == 'event' || Request::segment(2) == 'eventku' ? 'toggle' : 'collapse' }} submenu list-unstyled" id="event" data-parent="#accordionExample">
                        <li class="{{ Request::segment(2) == 'event' ? 'active' : '' }}">
                            <a href="{{ route('peserta.event.index') }}"> Pilih Event </a>
                        </li>
                        <li class="{{ Request::segment(2) == 'eventku' ? 'active' : '' }}">
                            <a href="{{ Route('peserta.eventku.index') }}"> Eventku </a>
                        </li>      
                    </ul>
                </li>
                <li class="menu">
                    <a href="#pengaturan" data-toggle="collapse" aria-expanded="{{ Request::segment(2) == 'profil' || Request::segment(2) == 'akun' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            <span> Pengaturan</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ Request::segment(2) == 'profil' || Request::segment(2) == 'akun' ? 'toggle' : 'collapse' }} submenu list-unstyled" id="pengaturan" data-parent="#accordionExample">
                        <li class="{{ Request::segment(2) == 'profil' ? 'active' : '' }}">
                            <a href="{{ url('/peserta/profil') }}"> Profil </a>
                        </li>
                        <li class="{{ Request::segment(2) == 'akun' ? 'active' : '' }}"">
                            <a href="{{ url('/peserta/akun') }}"> Akun </a>
                        </li>                           
                    </ul>
                </li>
            @endif
        </ul>
        
    </nav>

</div>