@extends('layouts.main')
@section('title')
    Pusat Bantuan
@endsection

@section('content')
<div id="faq" class="faq section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                    <h6>Pusat Bantuan</h6>
                    <h4>Dika Nakon Kula <em>Jawab</em></h4>
                    <div class="line-dec"></div>
                </div>
            </div>
            <div class="col-lg-12 wow fadeIn" data-wow-duration="0.5s" data-wow-delay="0.25s">
                <div class="accordion" id="accordionExample">
                    @forelse ($faq as $key => $dataFaq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $key }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">
                                    {{ $dataFaq->pertanyaan }}
                                </button>
                            </h2>
                            <div id="collapse{{ $key }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $dataFaq->jawaban !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Apa itu kegiatan pelibatan masyarakat?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Kegiatan Pelibatan Masyarakat merupakan kegiatan di perpustakaan untuk memfasilitasi kebutuhan masyarakat melalui penyediaan informasi yang luas (buku, internet, pelatihan) dengan melibatkan masyarakat secara aktif.
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="mt-2">
                    {{ $faq->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection