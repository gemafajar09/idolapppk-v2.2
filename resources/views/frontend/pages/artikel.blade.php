@php
    $tags = ['Home', 'PPPK', 'CPNS', 'BUKU', 'Soal', 'Tryout PPK', 'KISI-kisi terbaru', 'testimoni', 'info terbaru', 'youtuber'];
@endphp
@extends('frontend.layout.index')
<script src="https://cdn.tailwindcss.com"></script>
@section('content')
    <div class="container-lg mt-24 mb-5">
        <img src="{{asset('foto/'.$artikelx->foto)}}" class="w-full" alt="">
    </div>
    <div class="container-lg">
        <div>
            <h2 class="text-xl font-bold">PORTAL BERITA ONLINE</h2>
            <p>Artikel Informasi Terbaru Seputar CPNS & PPPK Support by IdolaPPPK.com</p>
            <div class="flex my-3 uppercase gap-2 text-white flex-wrap items-start">
                @foreach ($tags as $tag)
                    <a href="#" class="py-2 px-3 text-xl rounded flex-shrink-0 bg-[#856043]">
                        {{ $tag }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="mt-5">
            <h2 class="text-xl font-bold">BERITA POPULER</h2>
            <div class="flex flex-wrap flex-col md:flex-row gap-3">
                @foreach ($artikel as $no => $item)
                    @php
                        if ($no >= 3) {
                            break;
                        }
                    @endphp
                    <a href="" class="cursor-pointer relative md:w-1/4 flex-grow">
                        <img src="{{ asset('/foto/' . $item->foto) }}" class="w-full h-full" alt="...">
                        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white p-3">
                            {{ $item->judul }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="my-5">
            <div class="flex flex-col md:flex-row gap-3">
                <div class="md:w-2/3">
                    <h2 class="text-xl font-bold">BREAKING NEWS</h2>
                    <div class="flex flex-col lg:flex-row flex-wrap gap-3">
                        @foreach ($artikel as $no => $item)
                            @php
                                if ($no >= 2) {
                                    break;
                                }
                            @endphp
                            <a href="#" class="cursor-pointer relative lg:w-1/4 flex-grow">
                                <img src="{{ asset('/foto/' . $item->foto) }}" class="w-full h-full" alt="...">
                                <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white p-3">
                                    {{ $item->judul }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="md:w-1/3 pb-10">
                    <h2 class="text-xl font-bold">TAG POPULER</h2>
                    <ul>
                        @foreach ($tags as $no => $tag)
                            @php
                                if ($no >= 5) {
                                    break;
                                }
                            @endphp
                            <li class="lowercase text-xl">#{{ $tag }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="mt-5">
                <h2 class="text-xl font-bold">VIDEO TERBARU</h2>
                <div class="flex flex-col lg:flex-row gap-3">
                    <div class="lg:w-1/3">
                        <img src="{{ asset('/foto/' . $artikel[0]->foto) }}" class="w-full h-full" alt="...">
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl">{{ $artikel[0]->judul }}</h2>
                        {!! substr($item->isi, 0, 500) !!}
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <h2 class="text-xl font-bold">REKOMENDASI UNTUK ANDA</h2>
                <div class="flex flex-wrap flex-col md:flex-row gap-3">
                    @foreach ($artikel as $no => $item)
                        @php
                            if ($no >= 3) {
                                break;
                            }
                        @endphp
                        <a href="{{ route('frontend.detailArtikel', $item->slug) }}" class="cursor-pointer relative md:w-1/4 flex-grow">
                            <img src="{{ asset('/foto/' . $item->foto) }}" class="w-full h-full" alt="...">
                            <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white p-3">
                                {{ $item->judul }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    {{-- <section id="pricing" class="pricing">
        <div class="container" data-aos="fade-up">
            <div class="row" data-aos="fade-left">
                @foreach ($artikel as $item)
                    <div class="card" style="border:none;">
                        <div class="row g-0">
                            <div class="col-md-3">
                                <img src="{{ asset('/foto/' . $item->foto) }}" class="img-fluid rounded-start" alt="..."
                                    style="width: 100%">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h3 class="card-title fw-bold">{{ $item->judul }}</h3>
                                    <span class="badge bg-success mb-3">{{ $item->tipe }}</span>
                                    <p class="card-text text-secondary"><small>{!! substr($item->isi, 0, 500) !!}</small></p>
                                    <p class="card-text"><small class="text-muted"><a
                                                href="{{ route('frontend.detailArtikel', $item->slug) }}">Baca
                                                Selengkapnya...</a></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section> --}}
@endsection