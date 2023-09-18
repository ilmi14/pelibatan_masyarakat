
@extends('layouts.main')
@section('title')
    Berita
@endsection

@section('content')
<div id="blog" class="berita">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="col-lg-12 show-up wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="blog-post h-100 mb-3">
                        <div class="thumb">
                            <img height="230px" class="fit-image" src="{{ Storage::url($berita->banner) }}" alt="">
                        </div>
                        <div class="down-content">
                            <span class="category">{{ $berita->kategori->nama_kategori }}</span>
                            <span class="date">{{ \Carbon\Carbon::parse($berita->created_at)->format('j F Y') }}</span>
                            <h4>{{ $berita->judul }}</h4>
                            <div class="text-dark">
                                {!! $berita->isi !!}
                            </div>
                            <span class="author">
                                {{-- <img src="{{ asset('landing_page/assets/images/author-post.jpg') }}" alt=""> --}}
                                By: Admin
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="col-lg-12 show-up wow fadeInUp mb-3" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="card rounded shadow sticky-top">
                        <div class="card-header">
                            Rekomendasi Berita
                        </div>
                        <div class="card-body">
                            <ul>
                                @forelse ($rekomendasi as $itemRekomendasi)
                                    <li><a href="{{ url('berita/'.$itemRekomendasi->slug) }}">{{ $itemRekomendasi->judul }}</a></li>
                                @empty
                                    <li>Tidak ada rekomendasi berita saat ini.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="card-footer">
                            <form action="{{ url('berita') }}" method="GET" autocomplete="off">
                                <div class="input-group input-group-sm my-2">
                                    <input type="text" class="form-control" name="search" placeholder="Pencarian" value="" aria-label="Pencarian">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection