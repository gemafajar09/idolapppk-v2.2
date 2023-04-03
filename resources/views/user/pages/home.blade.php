@extends('user.layout.app')
@section('title', 'IdolaPPPK - Beranda')
@section('content')
@php
$id_pengguna = App\Helper\HashHelper::encryptData(session('id_pengguna'));
@endphp

@php
$user = DB::table('penggunas')
->where('id', session('id_pengguna'))
->first();
@endphp
<section class="section dashboard container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-4">
                    <a href="/paket/kategori" class="shadow bg-[#9e6925] rounded-xl relative card info-card sales-card text-white">
                        <div class="bg-inherit rounded-xl scale-95 -z-10 opacity-50 absolute top-0 left-0 w-full h-full translate-y-3"></div>
                        <div class="bg-inherit rounded-xl scale-90 -z-10 opacity-50 absolute top-0 left-0 w-full h-full translate-y-6"></div>
                        <div class="right-0 bottom-0 bg-contain m-3 w-20 h-20 absolute" style="background-image: url({{ asset('product-icon.png') }})"></div>
                        <div class="card-body py-10">
                            <h5 class="text-white mt-2">Paket Tersedia</h5>
                            <div class="d-flex align-items-center">
                                <h6 class="text-white !text-2xl mt-1">{{ $jumlah_paket }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="/paket-saya" class="shadow bg-[#9e6925] rounded-xl relative card info-card sales-card text-white">
                        <div class="bg-inherit rounded-xl scale-95 -z-10 opacity-50 absolute top-0 left-0 w-full h-full translate-y-3"></div>
                        <div class="bg-inherit rounded-xl scale-90 -z-10 opacity-50 absolute top-0 left-0 w-full h-full translate-y-6"></div>
                        <div class="right-0 bottom-0 bg-contain m-3 w-20 h-20 absolute" style="background-image: url({{ asset('my-product-icon.png') }})"></div>
                        <div class="card-body py-10">
                            <h5 class="text-white mt-2">Paket Saya</h5>
                            <div class="d-flex align-items-center">
                                <h6 class="text-white !text-2xl mt-1">{{ count($jumPaket)  }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="/pencairan/afiliasi-award" class="shadow bg-[#9e6925] rounded-xl relative card info-card sales-card text-white">
                        <div class="bg-inherit rounded-xl scale-95 -z-10 opacity-50 absolute top-0 left-0 w-full h-full translate-y-3"></div>
                        <div class="bg-inherit rounded-xl scale-90 -z-10 opacity-50 absolute top-0 left-0 w-full h-full translate-y-6"></div>
                        <div class="right-0 bottom-0 bg-contain m-3 w-20 h-20 absolute" style="background-image: url({{ asset('referral-icon.png') }})"></div>
                        <div class="card-body py-10">
                            <h5 class="text-white mt-2">Komisi Referal</h5>
                            <div class="d-flex align-items-center">
                                <h6 class="text-white !text-2xl mt-1">Rp. {{ number_format($user->saldo_afiliasi)  }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="flex gap-4 flex-col 2xl:flex-row">
                <div class="card rounded-lg info-card mt-3 sales-card shadow 2xl:w-2/3">
                    <div class="card-body">
                        <h3 class="pt-4 pb-2 fw-bold">Selamat Datang Di IDOLA PPPK</h3>
                        <p>
                            Program Belajar Sambil Bisnis, Peluang Cuan menjadi Mitra IDOLAPPPK, Ajak followers dan
                            Subscribers kamu untuk belajar bersama IDOLAPPPK dan dapatkan komisi referral sebesar
                            25% dari setiap penjualan paket dengan kode referral kamu. Yuk cek kode referral kamu
                            <a href="{{ route('frontend.profileSaya', $id_pengguna) }}">disini</a>
                        </p>

                        @php
                        $iklans = DB::table('iklans')->get();
                        @endphp

                        <div class="row pt-3 pb-3">
                            @foreach ($iklans as $item)
                            <div class="col-lg-4 col-md-4 col-12 mb-2">
                                <a href="{{ $item->link }}" target="_blank">
                                    <img src='{{ asset("foto/$item->foto") }}' class="rounded w-full" alt="iklan.png">
                                </a>
                            </div>
                            @endforeach

                            <p class="mt-3">
                                Catatan : Jangan lupa follow Instagram @idolapppk untuk informasi seputar PPPK dan
                                follow Toko Shopee @idolacpns untuk pembelian buku GRATIS ONGKIR !!!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card h-[560px] overflow-y-auto rounded-lg info-card mt-3 sales-card shadow 2xl:w-1/3 lg:w-1/2 w-full">
                    <div>
                        @foreach ($ig as $item)
                        {!! $item->embed !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">



            <div class="row">
                <div class="col-lg-12">

                    <div class="card shadow rounded-lg">
                        <div class="card-body">
                            <h5 class="card-title">F.A.Q</h5>

                            @php
                            $dataFaq = DB::table('faqs')->get();

                            @endphp

                            <!-- Accordion without outline borders -->
                            <style>
                                .show {
                                    visibility: inherit;
                                }
                            </style>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                @foreach ($dataFaq as $key => $item)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading{{ $key }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $key }}" aria-expanded="false" aria-controls="flush-collapse{{ $key }}">
                                            {{ $item->pertanyaan }}
                                        </button>
                                    </h2>
                                    <div id="flush-collapse{{ $key }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $key }}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">{{ $item->jawaban }}</div>
                                    </div>
                                </div>
                                @endforeach


                            </div><!-- End Accordion without outline borders -->

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>


@endsection