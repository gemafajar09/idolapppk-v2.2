@php
    $tags = ['Home', 'PPPK', 'CPNS', 'BUKU', 'Soal', 'Tryout PPK', 'KISI-kisi terbaru', 'testimoni', 'info terbaru', 'youtuber'];
@endphp
@extends('frontend.layout.index')
<script src="https://cdn.tailwindcss.com"></script>

@section('content')
    <div class="container-lg mt-24 mb-5">
        <div class="flex gap-2 uppercase">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                <path
                    d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8 8a2 2 0 0 0 2.828 0l7.172-7.172a2 2 0 0 0 0-2.828l-8-8zM7 9a2 2 0 1 1 .001-4.001A2 2 0 0 1 7 9z">
                </path>
            </svg>
            {{ $artikel->tipe }}
        </div>
        <div>
            <h1 class="text-5xl">{{ $artikel->judul }}</h1>
            {!! $artikel->isi !!}
        </div>
        <div class="flex gap-2 mt-4">
            <div class="font-bold">Kata Kunci: </div>
            <div>
                {{ join(", ", $tags) }}
            </div>
        </div>
        <div class="mt-5">
            <h2 class="text-xl font-bold">REKOMENDASI UNTUK ANDA</h2>
            <div class="flex flex-wrap flex-col md:flex-row gap-3">
                @foreach ($artikelseluruh as $no => $item)
                    @php
                        if ($no >= 3) {
                            break;
                        }
                    @endphp
                    <a href="{{ route('frontend.detailArtikel', $item->slug) }}"
                        class="cursor-pointer relative md:w-1/4 flex-grow">
                        <img src="{{ asset('/foto/' . $item->foto) }}" class="w-full h-full" alt="...">
                        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white p-3">
                            {{ $item->judul }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- <section id="pricing" class="pricing">
        <div class="container" data-aos="fade-up">
            <div class="row" data-aos="fade-left">
                <div class="col-lg-8">
                    <div class="card">
                        <img src="{{ asset('/foto/'.$artikel->foto) }}" class="card-img-top" alt="" style="width: 30em;">
                        <div class="card-body">
                        <h3 class="card-title fw-bold">{{ $artikel->judul }}</h3>
                        <span class="badge bg-success mb-3">{{ $artikel->tipe }}</span>
                        <p class="card-text"><small>{!! $artikel->isi !!}</small></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        @foreach ($artikelseluruh as $item)
                        <div class="row g-0">
                            <div class="col-md-4">
                              <img src="{{ asset('/foto/'.$item->foto) }}" class="" alt="..." style="width: 120%;">
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h6 class="card-title fw-bold">{{ $item->judul }}</h6>
                                <span class="badge bg-success mb-2"><small>{{ $item->tipe }}</small></span>
                                <br>
                                <p class="card-text text-secondary"><small>{!! substr($item->isi, 0, 50) !!}</small></p>
                                <small class="text-muted"><a href="{{ route('frontend.detailArtikel', $item->slug) }}">Baca Selengkapnya...</a></small>
                              </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection