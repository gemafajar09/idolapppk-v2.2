@extends('user.layout.app')
@section('title', 'IdolaPPPK - Paket Tersedia')

@section('content')
    <div class="pagetitle">
        <h1>Kategori Paket</h1>

    </div>

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            @if($paket != null)
                                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 style="color: #000;" class="mt-3 mb-4 fw-bold text-center">{{ $paket->nama_paket }}</h4>


                                            <div class="price text-center mb-2"><sup>Rp.
                                                </sup>{{ number_format($paket->harga_coret) }}<sub>/ {{ $paket->masa_aktif }} Bulan</sub></div>


                                            <form action="{{ route('frontend.keranjang.proses') }}" method="POST"
                                                class="text-center">
                                                @csrf
                                                <input type="hidden" name="type" value="{{$kategori_kelas}}">
                                                <input type="hidden" name="id_paket"
                                                    value="{{ App\Helper\HashHelper::encryptData($paket->id_pakets) }}">
                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn border-[#9e6925] hover:!text-[#9e6925] text-white bg-[#9e6925] hover:bg-white mt-2 flex items-center gap-2 justify-center">
                                                        <i class='bx bxs-cart text-2xl' ></i>
                                                        Beli Sekarang
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <h5 class="mt-4">Belum Terdapat Paket Pada Kategori Ini</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
