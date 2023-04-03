@extends('frontend.layout.index')

@section('content')
    @include('frontend.components.breadcumb', [
        'title' => 'Halaman Pembelian',
        'subtitle' => 'Pembelian',
    ])
    <!-- ======= Pricing Section ======= -->
    <section id="detail" class="keranjang">

        <div class="container" data-aos="fade-up">

            <div class="row gy-4" data-aos="fade-left">

                @php
                    $harga_asli = $tmp->harga_coret ?? 0;
                    $harga_afiliasi = $tmp->harga ?? 0;
                @endphp

                <div class="col-lg-8 col-md-12" data-aos="zoom-in" data-aos-delay="200">
                    <div class="box">
                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <h3 style="color: #65c600;">{{ $tmp->paket->nama_paket ?? '' }}</h3>
                                <a href="{{ route('frontend.paketAll') }}"
                                    class="btn-lainnya btn btn-primary d-none d-lg-block">Paket
                                    Lainnya</a>
                                <a href="{{ route('frontend.paketAll') }}"
                                    class="btn-lainnya-mobile btn btn-white btn-sm d-block d-lg-none">
                                    Paket Lainnya</a>
                            </div>
                        </div>
                        <h5>Fasilitas Yang Tersedia</h5>
                        <ul class="mt-4">
                            @php
                                $fasilitas_paket = $tmp->paket->fasilitas ?? [];
                            @endphp
                            @foreach ($fasilitas_paket as $fasilitas)
                                <li><span class="fasilitassuccess">&#10003;</span> {{ $fasilitas->nama_fasilitas }}</li>
                            @endforeach
                        </ul>
                        <h6>*Dapatkan potongan Diskon sebesar Rp 30.000 dengan memasukan kode referal dan terakhir klik Pembelian</h6>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12" data-aos="zoom-in" data-aos-delay="200">
                    <div class="box text-center">
                        <span class="featured">Checkout</span>
                        <h3 style="color: #65c600;">Total Keranjang</h3>
                        @php
                            if (session()->has('kode_afiliasi')) {
                                $harga = $harga_afiliasi;
                            } else {
                                $harga = $harga_asli;
                            }
                        @endphp
                        <div class="price1"><sup>Rp.</sup>{{ number_format($harga) }}</div>
                        <form action="{{ route('frontend.checkout.proses') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-buy btn btn-white mt-4">Pembelian</button>
                        </form>

                        <div class="mt-5">
                            <form class="row" action="{{ route('frontend.keranjang.setKodeAfiliasi') }}"
                                method="POST">
                                @csrf
                                <div class="col-auto">
                                    <label for="staticEmail2" class="visually-hidden">kode Referal</label>
                                    <input type="text" class="form-control" id="staticEmail2"
                                        placeholder="Masukan Kode Referal" name="kode_afiliasi"
                                        value="{{ session('kode_afiliasi') }}">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3">Apply</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-12 col-12 col-md-12">
                            <div class="card text-dark text-center bg-light mb-2">
                                <div class="card-header">
                                    Penggunaan Kode Referal</div>
                                        <h6 class=" text-dark">
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

    </section>
    <!-- End Pricing Section -->
@endsection
