@extends('frontend.layout.index')

@section('content')
    @include('frontend.components.breadcumb',['title'=>"Halaman Billing",'subtitle'=>"Billing"])
    <!-- ======= Pricing Section ======= -->
    <section id="registrasi" class="billing">

        <div class="container" data-aos="fade-up">

            <div class="row gy-4" data-aos="fade-left">

                <div class="col-lg-7 col-md-12" data-aos="zoom-in" data-aos-delay="200" style="margin:auto;">
                    <div class="box">
                        <h3 style="color: #65c600;">Invoice Pembayaran</h3>
                        <h6>{{$pembelian->kode_pembelian}}</h6>
                        <img src="{{asset('frontend/assets/img/web/billing.svg')}}" class="img-fluid img-responsive" alt="">
                        <div class="row px-3 mt-5" style="text-align: left;">
                            <div class="col-lg-6 col-12 shadow-sm p-3 mb-3 bg-body rounded" style="margin-right:2em;">
                                <h5>Transfer Bank BNI</h5>
                                <div class="row">
                                    <div class="col-lg-6 col-6 col-md-6">
                                        <span>1371073219</span>
                                        <br>
                                        <span>IdolaPPPK</span>
                                    </div>
                                    <div class="col-lg-6 col-6 col-md-6">
                                        <img src="{{ asset('frontend/assets/img/web/bank/bni.png') }}" alt=""
                                            style="width: 5em;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-12 shadow-sm p-3 mb-3 bg-body rounded text-center">
                                <h5>Total Pembayaran</h5>
                                <div class="price"><sup>Rp.</sup>{{number_format($pembelian->total_bayar)}}</div>
                            </div>

                        </div>
                        <div class="row px-3" style="text-align:left;">
                            <div class="col-lg-12">
                                <p>Silahkan menunggu konfirmasi pembayaran dari admin dalam waktu 60 menit, Jika paket soal belum aktif silahkan menghubungi admin WhatsApp, <a href="https://wa.me/6282227696256" target="_blank">Klik
                                        Disini</a></p>
                            </div>
                            <div class="col-lg-12 alert alert-info">
                                <p><b>Note :</b> Pastikan nominal pembayaran harus sama dengan total yang tertera. karena 3 digit dibelakang nominal adalah kode aktifasi paket anda.</p>
                            </div>

                        </div>
                        <div class="row px-3 mt-5">
                            <div class="col-lg-12">
                                <p style="margin:0;">Terimakasih Sudah Berlangganan</p>
                                <img src="{{asset('frontend/baru/images/logo.png')}}" alt="logo.png">
                                <br>
                                <a href="{{route('frontend.index')}}" class="btn-buy">Beranda</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </section>
    <!-- End Pricing Section -->
@endsection
