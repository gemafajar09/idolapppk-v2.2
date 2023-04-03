@extends('frontend.layout.index')

@section('content')
    @include('frontend.components.breadcumb',['title'=>"Halaman Detail Paket",'subtitle'=>"Detail"])
    <!-- ======= Pricing Section ======= -->
    <section id="detail" class="detail">

        <div class="container" data-aos="fade-up">

            <div class="row gy-4" data-aos="fade-left">

                <div class="col-lg-8 col-md-12 order-2 order-lg-1" data-aos="zoom-in" data-aos-delay="200">
                    <div class="box">
                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <h3 style="color: #65c600;">{{ $paket->nama_paket }}</h3>
                                <a href="{{ route('frontend.paketAll') }}"
                                    class="btn-lainnya btn btn-white d-none d-lg-block">Paket
                                    Lainnya</a>
                                <a href="{{ route('frontend.paketAll') }}"
                                    class="btn-lainnya-mobile btn btn-white btn-sm d-block d-lg-none">
                                    Paket Lainnya</a>
                            </div>
                        </div>
                        <h5>Fasilitas Yang Tersedia</h5>
                        <ul class="mt-4">
                            <li><span>&#10003;</span> Materi teks PPPK Terupdate sesuai Permenpan RB</li>
                            <li><span>&#10003;</span> Video Materi PPPK (Tes Manajerial, Tes Sosio-kultural, Pertanyaan
                                Wawancara) </li>
                            <li><span>&#10003;</span> Tryout berbasis computer CAT BKN</li>
                            <li><span>&#10003;</span> Paket 1 Tryout PPPK Tenaga Kesehatan</li>
                            <li><span>&#10003;</span> Paket 2 Tryout PPPK Tenaga Kesehatan</li>
                            <li><span>&#10003;</span> Paket 3 Tryout PPPK Tenaga Kesehatan</li>
                            <li><span>&#10003;</span> Paket 4 Tryout PPPK Tenaga Kesehatan</li>
                            <li><span>&#10003;</span> Paket 5 Tryout PPPK Tenaga Kesehatan</li>
                            <li><span>&#10003;</span> GRATIS Update-an Soal Terbaru selama setahun</li>
                            <li><span>&#10003;</span> Jawaban dan Pembahasan Lengkap</li>
                            <li><span>&#10003;</span> Grafik statistik Hasil Tryout</li>
                            <li><span>&#10003;</span> Rangking Tryout Nasional</li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="200">
                    <div class="box text-center">
                        <span class="featured">Beli Sekarang</span>
                        <h3 style="color: #65c600;">Harga Paket</h3>
                        @if (!empty($paket->harga_coret) || $paket->harga_coret != 0)
                            <div class="price"><sup>Rp.</sup><del>{{number_format($paket->harga_coret)}}</del></div>
                        @endif
                        <div class="price"><sup>Rp.</sup>{{ number_format($paket->harga_paket) }}<span
                                style="font-size:.7em;color:black"> /{{ $paket->masa_aktif }} Bulan</span></div>
                        <form action="{{ route('frontend.keranjang.proses') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_paket"
                                value="{{ App\Helper\HashHelper::encryptData($paket->id) }}">
                            <button type="submit" class="btn-buy btn btn-white mt-4">Beli Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- End Pricing Section -->
@endsection
