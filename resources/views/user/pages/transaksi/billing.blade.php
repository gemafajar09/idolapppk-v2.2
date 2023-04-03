@extends('user.layout.app')
@section('title', 'IdolaPPPK - Billing')

@section('content')
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-8 offset-md-2">
            <div class="row">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="col-lg-12 col-md-12"  style="margin:auto;">
                            <div class="box text-center">
                                <h3 style="color: #65c600;">Invoice Pembayaran</h3>
                                <h6>{{$pembelian->kode_pembelian}}</h6>
                                <img src="{{asset('frontend/assets/img/web/billing.svg')}}" class="img-fluid img-responsive" width="250">
                                <div class="row px-3 mt-5" style="text-align: left;">
                                    <div class="col-lg-6 col-12 shadow-sm p-3 mb-3 bg-body rounded" style="margin-right:2em;">
                
                                        <button type="button" onclick="bayars('{{$pembelian->id}}')" class="btn btn-info">Bayar Sekarang</button>
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
                                    <!-- <div class="col-lg-12 alert alert-info">
                                        <p><b>Note :</b> Pastikan nominal pembayaran harus sama dengan total yang tertera. karena 3 digit dibelakang nominal adalah kode aktifasi paket anda.</p>
                                    </div> -->
                                </div>
                                <div class="row px-3 mt-2">
                                    <div class="col-lg-12">
                                        <p style="margin-bottom:10px;">Terimakasih Sudah Berlangganan</p>
                                        <img src="{{asset('frontend/baru/images/logo.png')}}" alt="logo.png" width="250" class="mx-auto">
                                        <br><br>
                                        <a href="{{route('frontend.index')}}" class="btn btn-primary">Beranda</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://api.midtrans.com/snap/snap.js"  data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        function bayars(id) {
        $.ajax({
            url: "{{url('api/cekPembayaran')}}/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(res){
                snap.pay(res.snap, {
                    // Optional
                    onSuccess: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        $.ajax({
                            url: "{{url('api/ferifikasiOnline')}}",
                            type: "POST",
                            datatype: "JSON",
                            data: {
                                id_transaksi :  '{{$pembelian->id}}',
                                kode_pembelian : '{{$pembelian->kode_pembelian}}' ,
                                status : 'Berhasil'
                            },
                            success: function(res){
                                window.location='/'
                            }
                        })
                        console.log(result)
                    },
                    // Optional
                    onPending: function(result) {

                        console.log(result)
                    },
                    // Optional
                    onError: function(result) {
                        console.log(result)
                    }
                });
            }
        })

    }

    </script>
@endsection
