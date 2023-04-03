@extends('frontend.layout.index')

@section('content')
    @include('frontend.components.breadcumb',['title'=>"Halaman Paket",'subtitle'=>"Paket"])
    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">

        <div class="container" data-aos="fade-up">

            <div class="row gy-4" data-aos="fade-left">
                @foreach ($paket as $item)
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="box">
                            <h3 style="color: #65c600;">{{ $item->nama_paket }}</h3>
                            @if (!empty($item->harga_coret) || $item->harga_coret != 0)
                                <div class="price1"><sup>Rp.</sup><del>{{ number_format($item->harga_coret) }}</del>
                                </div>
                            @endif
                            <div class="price"><sup>Rp.</sup>{{ number_format($item->harga_paket) }}<span>
                                    /{{ $item->masa_aktif }} Bulan</span></div>

                            <ul class="mt-4">
                                @foreach ($item->fasilitas as $fasilitas)
                                    <li><span class="fasilitassuccess">&#10003;</span> {{$fasilitas->nama_fasilitas}}</li>
                                @endforeach

                            </ul>
                            <form action="{{ route('frontend.keranjang.proses') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_paket"
                                    value="{{ App\Helper\HashHelper::encryptData($item->id) }}">
                                <button type="submit" class="btn-buy btn btn-white mt-4">Beli Sekarang</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Pricing Section -->
@endsection
