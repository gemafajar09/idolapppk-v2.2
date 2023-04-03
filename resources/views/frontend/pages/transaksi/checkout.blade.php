@extends('frontend.layout.index')

@section('content')
    @include('frontend.components.breadcumb', [
        'title' => 'Halaman Checkout',
        'subtitle' => 'Checkout',
    ])
    <!-- ======= Pricing Section ======= -->
    <section id="detail" class="checkout">

        <div class="container" data-aos="fade-up">
            <form action="{{ route('frontend.checkout.proses') }}" method="POST">
                @csrf
                <div class="row gy-4" data-aos="fade-left">

                    <div class="col-lg-8 col-md-12" data-aos="zoom-in" data-aos-delay="200">
                        <div class="row">
                            <div class="col-lg-12 col-12 col-md-12 order-lg-1 order-2">
                                <div class="box mb-4">
                                    <div class="row mb-3">
                                        <div class="col-lg-7 col-12 col-md-12 mb-3">
                                            <h3 class="mb-4" style="color: #65c600;"><i
                                                    class="ri-secure-payment-line"></i>
                                                Checkout</h3>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="bank"
                                                    id="flexRadioDefault1" required value="bni">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Bank Transfer Ke BNI
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="bank"
                                                    id="flexRadioDefault1" required value="bri">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Bank Transfer Ke BRI
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="bank"
                                                    id="flexRadioDefault1" required value="mandiri">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Bank Transfer Ke Mandiri
                                                </label>
                                            </div>

                                        </div>
                                        <div class="col-lg-5 col-12 col-md-12">
                                            <div class="card text-dark text-center bg-light mb-2">
                                                <div class="card-header" style="background-color:#012970;color:white;">
                                                    Penggunaan Kode Referal</div>
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-center">
                                                        <h6 class="card-title text-dark">
                                                            @if (session()->has('kode_afiliasi'))
                                                                @if (!empty(session('kode_afiliasi')))
                                                                    {{ session('kode_afiliasi') }}
                                                                @else
                                                                    {{ 'Tidak Ada' }}
                                                                @endif
                                                            @else
                                                                {{ 'Tidak Ada' }}
                                                            @endif
                                                        </h6>
                                                        @if (session()->has('kode_afiliasi'))
                                                            @if (!empty(session('kode_afiliasi')))
                                                                <a href="{{ route('frontend.checkout.removeKodeAfiliasi') }}"
                                                                    style="margin-top:-.3em;color:red;font-weight:700;"
                                                                    class="kode_referal">x</a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- detail order --}}
                            <div class="col-lg-12 col-12 col-md-12 order-lg-2 order-1">
                                <div class="box mb-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="mb-4" style="color: #65c600;font-size:1.4em;"><i
                                                    class="ri-price-tag-3-fill"></i> Order Detail
                                            </h3>
                                            @php
                                                $total_tmp = 0;
                                            @endphp
                                            @foreach ($tmp as $item)
                                                @php
                                                    $harga = 0;
                                                    if (session()->has('kode_afiliasi')) {
                                                        $total_tmp += $item->harga;
                                                        $harga = $item->harga;
                                                    } else {
                                                        $total_tmp += $item->harga_coret;
                                                        $harga = $item->harga_coret;
                                                    }
                                                @endphp
                                                <div class="row mb-3 border-bottom pb-3">
                                                    <div class="col-lg-2 col-2">
                                                        <img src="{{ asset('frontend/assets/img/features-3.png') }}"
                                                            alt="" class="img-responsive">
                                                    </div>
                                                    <div class="col-lg-6 col-5 d-flex align-items-center">
                                                        <h5>{{ $item->paket->nama_paket ?? '' }}</h5>
                                                    </div>
                                                    <div
                                                        class="col-lg-4 col-5 d-flex align-items-center justify-content-center">
                                                        <div class="pricebaru mt-2"><sup>Rp.
                                                                {{ number_format($harga) }}<span>/{{ $item->masa_aktif }}
                                                                    Bulan</sup></span></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 col-md-12" data-aos="zoom-in" data-aos-delay="200">
                        <div class="box text-center">
                            <span class="featured">Checkout</span>
                            <h3 style="color: #65c600;">Total Pembayaran</h3>
                            <div class="price"><sup>Rp.</sup>{{ number_format($total_tmp) }}</div>
                            <button type="submit" class="btn-buy btn btn-white mt-4">Bayar Sekarang</button>

                        </div>
                    </div>
                </div>
            </form>

        </div>

    </section>
    <!-- End Pricing Section -->
@endsection
