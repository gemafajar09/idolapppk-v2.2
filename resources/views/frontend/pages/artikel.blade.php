@php
    \Carbon\Carbon::setlocale('id_ID');
@endphp
@extends('frontend.layout.index')
<script src="https://cdn.tailwindcss.com"></script>
<style>
    ::-webkit-scrollbar {
        height: 3px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@section('content')
    <div class="container-lg mt-24 mb-5">
        @php
            $banner = scandir('foto/banner/');
            $banner = $banner[2] ?? false;
        @endphp
        @if ($banner)
            <img src="{{ asset('foto/banner/' . $banner) }}" class="w-full" alt="">
        @endif
    </div>
    <div class="container-lg">
        <div>
            <h2 class="text-xl font-bold">PORTAL BERITA ONLINE</h2>
            <p>Artikel Informasi Terbaru Seputar CPNS & PPPK Support by IdolaPPPK.com</p>
            <div class="flex my-3 pb-2 uppercase gap-2 text-white overflow-x-auto items-start">
                @foreach ($tags as $tag)
                    <a href="{{ route('frontend.artikelTags', $tag->id) }}"
                        class="py-2 px-4 text-sm hover:text-white hover:bg-opacity-100 rounded-full flex-shrink-0 bg-opacity-90 bg-[#a87d5a]">
                        {{ $tag->value }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="mt-5">
            <h2 class="text-xl font-bold mb-1">BERITA POPULER</h2>
            <div class="flex flex-wrap gap-3">
                @foreach ($berita_populer as $no => $item)
                    <a href="{{ route('frontend.detailArtikel', $item->slug) }}"
                        class="cursor-pointer w-1/3 md:w-1/5 flex-grow">
                        <div class="w-full rounded bg-cover bg-center pb-[63%]"
                            style="background-image: url('{{ asset('/foto/' . $item->foto) }}')"></div>
                        <div class="text-xs pt-2">
                            @php
                                $date = \Carbon\Carbon::parse($item->created_at)->locale('id');
                                $date->settings(['formatFunction' => 'translatedFormat']);
                            @endphp
                            {{ $date->format('l, j F Y, h:i') }} WIB
                        </div>
                        <h3 class="text-xs sm:text-sm xl:text-lg font-bold pt-1 sm:pt-3">
                            {{ $item->judul }}
                        </h3>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="mt-5">
            <div class="flex flex-col justify-start md:flex-row gap-3">
                <div class="md:w-2/3">
                    <h2 class="text-xl font-bold mb-1">BREAKING NEWS</h2>
                    <div class="flex flex-col gap-3">
                        @foreach ($breaking_news as $no => $item)
                            <a href="{{ route('frontend.detailArtikel', $item->slug) }}" class="cursor-pointer flex gap-3">
                                <div class="w-[300px] pb-[20%] rounded bg-cover bg-center"
                                    style="background-image: url('{{ asset('/foto/' . $item->foto) }}')"></div>
                                <div class="flex-1">
                                    <div class="text-sm">
                                        {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    </div>
                                    <h3 class="text-xs sm:text-sm xl:text-lg font-bold pt-1 sm:pt-3">
                                        {{ $item->judul }}
                                    </h3>
                                    <p class="opacity-70 text-sm pt-2">
                                        {{ substr(strip_tags($item->isi), 0, 200) }}...
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="md:w-1/3 pb-10 mt-5 md:!mt-0">
                    <h2 class="text-xl font-bold">TAG POPULER</h2>
                    <ul class="flex flex-wrap gap-x-3 md:!gap-0">
                        @foreach ($tags as $no => $tag)
                            <li class="lowercase text-xl md:w-1/2 font-bold flex items-center gap-1 md:py-0">
                                <a href="{{ route('frontend.artikelTags', $tag->id) }}" class="whitespace-nowrap">
                                    <span class="opacity-40">#</span>
                                    {{ $tag->value }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div>
                <h2 class="text-xl font-bold mt-0 sm:!mt-10">VIDEO TERBARU</h2>
                <div class="flex gap-3 flex-col md:flex-row">
                    @foreach ($video as $item)
                        <div class="w-full md:w-1/2 pb-[60%] md:pb-[30%] relative">
                            <iframe class="w-full h-full absolute" src="{{ $item->link }}?rel=0" title="YouTube video"
                                allowfullscreen></iframe>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="my-5">
                <h2 class="text-xl font-bold mb-1">REKOMENDASI UNTUK ANDA</h2>
                <div class="flex flex-wrap gap-3">
                    @foreach ($rekomendasi as $no => $item)
                        <a href="{{ route('frontend.detailArtikel', $item->slug) }}"
                            class="cursor-pointer w-1/3 md:w-1/5 flex-grow">
                            <div class="w-full rounded bg-cover bg-center pb-[63%]"
                                style="background-image: url('{{ asset('/foto/' . $item->foto) }}')"></div>
                            <div class="text-xs pt-2">
                                @php
                                    $date = \Carbon\Carbon::parse($item->created_at)->locale('id');
                                    $date->settings(['formatFunction' => 'translatedFormat']);
                                @endphp
                                {{ $date->format('l, j F Y, h:i') }} WIB
                            </div>
                            <h3 class="text-xs sm:text-sm xl:text-lg font-bold pt-1 sm:pt-3">
                                {{ $item->judul }}
                            </h3>
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
