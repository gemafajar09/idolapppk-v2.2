@extends('frontend.layout.index')
<script src="https://cdn.tailwindcss.com"></script>
@section('content')
    <div class="container-lg mt-24 mb-5">
        <h3 class="font-bold text-4xl uppercase">{{ $tag->value }}</h3>
        <div class="flex gap-5 flex-col xl:flex-row">
            <div class="flex gap-3 py-4 flex-col flex-1">
                @if (!count($artikel))
                    <div class="flex flex-col justify-center items-center">
                        <h3 class="text-2xl font-bold">Artikel Tidak Ditemukan</h3>
                    </div>
                @endif
                @foreach ($artikel as $item)
                    <div class="flex flex-col md:flex-row gap-3 justify-start items-start">
                        <a href="{{ route('frontend.detailArtikel', $item->slug) }}" class="w-full pb-[50%] md:w-1/3 md:pb-[20%] bg-cover bg-center"
                            style="background-image: url('{{ asset('/foto/' . $item->foto) }}')"></a>
                        <div class="flex-1">
                            <div class="flex gap-2 pb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                {{ $item->view }} Viewer
                            </div>
                            <a href="{{ route('frontend.detailArtikel', $item->slug) }}" class="text-2xl sm:text-3xl font-semibold">
                                {{ $item->judul }}
                            </a>
                            <p class="text-sm text-gray-500">
                                {{ $item->created_at }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="xl:w-[500px]">
                <h2 class="text-2xl font-bold">TAGS</h2>
                <div class="mt-2">
                    @foreach ($tags as $item)
                        <a href="{{ route('frontend.artikelTags', $item->id) }}"
                            class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mb-2">
                            {{ $item->value }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
