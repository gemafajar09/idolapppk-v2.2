@extends('frontend.layout.index')
<script src="https://cdn.tailwindcss.com"></script>

@section('content')
    <div class="container-lg mt-24 mb-5">
        <div class="flex gap-5 flex-col lg:flex-row">
            <div class="flex-1">
                <div class="flex gap-2 uppercase mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <path
                            d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8 8a2 2 0 0 0 2.828 0l7.172-7.172a2 2 0 0 0 0-2.828l-8-8zM7 9a2 2 0 1 1 .001-4.001A2 2 0 0 1 7 9z">
                        </path>
                    </svg>
                    <div>
                        @php
                            $tags = json_decode($artikel->tags, true) ?? [];
                            $tagss = [];
                            foreach ($tags as $tag) {
                                $index = $artikels_tags->filter(function ($value, $key) use ($tag) {
                                    return $value->id == $tag;
                                });

                                if (count($index) > 0) {
                                    $index = array_keys($index->toArray())[0];
                                    $tagss[] = $artikels_tags[$index];
                                }
                            }
                        @endphp
                        @foreach ($tagss as $no => $item)
                            <a href="{{ route('frontend.artikelTags', $item->id) }}"
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mb-2">
                                {{ $item->value }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h1 class="text-5xl mb-3 font-bold font-serif">{{ $artikel->judul }}</h1>
                    <div class="my-3 flex justify-center">
                        <div class="a2a_kit a2a_kit_size_42 a2a_default_style" data-a2a-title=" ">
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_whatsapp"></a>
                            <a class="a2a_button_twitter"></a>
                        </div>
                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                    </div>
                    @php
                        $date = \Carbon\Carbon::parse($artikel->created_at)->locale('id');
                        $date->settings(['formatFunction' => 'translatedFormat']);
                    @endphp
                    <div class="flex justify-center gap-2 mb-3 text-xs sm:text-base items-center">
                        <div>
                            {{ $date->format('l, j F Y, h:i') }} WIB
                        </div>
                        |
                        <div class="flex gap-1 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                <path
                                    d="M12 10c1.151 0 2-.848 2-2s-.849-2-2-2c-1.15 0-2 .848-2 2s.85 2 2 2zm0 1c-2.209 0-4 1.612-4 3.6v.386h8V14.6c0-1.988-1.791-3.6-4-3.6z">
                                </path>
                                <path
                                    d="M19 2H5c-1.103 0-2 .897-2 2v13c0 1.103.897 2 2 2h4l3 3 3-3h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm-5 15-2 2-2-2H5V4h14l.002 13H14z">
                                </path>
                            </svg>
                            <span>
                                {{ $artikel->view }}
                            </span>
                        </div>
                    </div>
                    <div class="mb-3 text-xs text-gray-700">
                        <img class="w-full" src="{{ asset('/foto/' . $artikel->foto) }}" />
                        {{ $artikel->foto_cite }}
                    </div>
                    {!! $artikel->isi !!}
                </div>
                <div class="my-3 flex justify-start">
                    <div class="a2a_kit a2a_kit_size_42 a2a_default_style" data-a2a-title=" ">
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_whatsapp"></a>
                        <a class="a2a_button_twitter"></a>
                    </div>
                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                </div>
                <div class="flex gap-2 mt-2">
                    <div class="font-bold">Kata Kunci: </div>
                    <div class="uppercase">
                        @foreach ($tagss as $no => $item)
                            <a href="{{ route('frontend.artikelTags', $item->id) }}"
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mb-2">
                                {{ $item->value }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-[450px]">
                <h2 class="text-xl font-bold mb-1">BERITA POPULER</h2>
                <div class="flex flex-col md:flex-row flex-wrap lg:flex-col gap-3">
                    @foreach ($berita_populer as $no => $item)
                        <a href="{{ route('frontend.detailArtikel', $item->slug) }}"
                            class="cursor-pointer w-full md:w-1/3 lg:w-full flex-grow flex gap-2">
                            <div class="w-[160px] rounded bg-cover bg-center pb-[23%]"
                                style="background-image: url('{{ asset('/foto/' . $item->foto) }}')"></div>
                            <h3 class="text-lg flex-1 font-semibold pt-1 sm:pt-3">
                                <div class="text-xs">
                                    @php
                                        $date = \Carbon\Carbon::parse($item->created_at)->locale('id');
                                        $date->settings(['formatFunction' => 'translatedFormat']);
                                    @endphp
                                    {{ $date->format('l, j F Y, h:i') }} WIB
                                </div>
                                {{ $item->judul }}
                            </h3>
                        </a>
                    @endforeach
                </div>
                <h2 class="text-xl font-bold mb-1 mt-5">TAG POPULER</h2>
                <div class="mt-2">
                    @foreach ($tags_all as $item)
                        <a href="{{ route('frontend.artikelTags', $item->id) }}"
                            class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mb-2">
                            {{ $item->value }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-4">
            <h2 class="text-xl font-bold">REKOMENDASI UNTUK ANDA</h2>
            <div class="flex flex-wrap gap-3">
                @foreach ($artikelseluruh as $no => $item)
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
