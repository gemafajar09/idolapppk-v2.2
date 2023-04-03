@extends('user.layout.app')
@section('title', 'IdolaPPPK - Paket Saya')

@php
    function fileImg($id){
        $ext = ['svg', 'png', 'jpg', 'jpeg'];
        foreach ($ext as $e) {
            if (file_exists(public_path("frontend/storyset/{$id}.{$e}"))) {
                return asset("frontend/storyset/{$id}.{$e}");
            }
        }
    }
@endphp

@section('content')
    <div class="container">
        <div class="pagetitle">
            <h1>Paket Saya</h1>

        </div>

        <section class="section dashboard">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-6" data-aos="zoom-in" data-aos-delay="100">
                            <div class="card font-bold shadow flex items-center py-4 " onclick="change('mandiri')" id="mandiri">
                                <i class='bx bxs-user text-2xl' ></i>
                                Mandiri
                                <p class="text-sm font-light px-3 text-center">Metode belajar mandiri dengan mengerjakan tryout yang tersedia pada PAKET SAYA.</p>
                            </div>
                      </div>
                      <div class="col-6" data-aos="zoom-in" data-aos-delay="100">
                            <div class="card font-bold shadow flex items-center py-4" onclick="change('bimbel')" id="bimbel">
                                <i class='bx bxs-group text-2xl' ></i>
                                Bimbel
                                <p class="text-sm font-light px-3 text-center">Metode belajar interaktif bersama pengajar profesional secara virtual / Online.</p>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                        @if (count($paket) > 0)
                            @foreach ($paket as $item)
                                @php
                                    $data = [
                                        'id_paket' => $item->id_paket,
                                        'id_detail' => $item->id,
                                    ];
                                    
                                    $pakets = App\Helper\HashHelper::encryptArray($data);
                                    $id_paket = $item->id_paket;
                                    
                                    $masaaktif = date('Y-m-d', strtotime('+6 months', strtotime($item->tanggal_aktifasi)));
                                @endphp
                                @if(isset($item->paket->kategori->type))
                                <div class="col-lg-4 col-md-6 mt-3 paket {{ $item->paket->kategori->type }}">
                                    <div class="card h-100 pt-4">
                                        <img src='{{ asset($item->paket->kategori->banner) }}' class="card-img-top"
                                            alt="...">
                                        <div class="card-header">
                                            <h5 class="card-title m-0">{{ $item->paket->nama_paket ?? '' }}</h5>
                                            <p class="card-text m-0">{{ $item->paket->deskripsi_paket ?? '' }}</p>
                                            <div>
                                                <div class="text-xs">Berlaku Hingga:</div>
                                                <div>{{ App\Helper\HashHelper::tanggal_indonesia($masaaktif) }}</div>
                                            </div>
                                        </div>
                                        <div class="card-body py-0">
                                            <br>
                                            @foreach ($item->paket->fasilitas as $fasilitas)
                                                    @if ($fasilitas->tipe_fasilitas == 'Materi Video')
                                                        <div class="row pt-1">
                                                            <div class="col-10">
                                                                <p class="text-secondary">{{ $fasilitas->nama_fasilitas }}</p>
                                                            </div>
                                                            <div class="col-2">
                                                                <span class="float-end"><a class="btn bg-[#9e6925] text-white btn-sm"
                                                                        href="{{ route('frontend.service.materiPaketSayaDetail',$pakets) }}"><i
                                                                            class="ri-external-link-line"></i></a></span>
                                                            </div>
                                                        </div>
                                                    @elseif($fasilitas->tipe_fasilitas == 'Materi PDF')
                                                        <div class="row pt-1">
                                                            <div class="col-10">
                                                                <p class="text-secondary">{{ $fasilitas->nama_fasilitas }}</p>
                                                            </div>
                                                            <div class="col-2">
                                                                <span class="float-end"><a class="btn bg-[#9e6925] text-white btn-sm"
                                                                        href="{{ route('frontend.service.materiPaketSayaPdfDetail', $pakets) }}"><i
                                                                            class="ri-external-link-line"></i></a></span>
                                                            </div>
                                                        </div>
                                                    @elseif($fasilitas->tipe_fasilitas == 'Ujian')
                                                        <div class="row pt-1">
                                                            <div class="col-10">
                                                                <p class="text-secondary">{{ $fasilitas->nama_fasilitas }}</p>
                                                            </div>
                                                            <div class="col-2">
                                                                <span class="float-end"><a class="btn bg-[#9e6925] text-white btn-sm" target="_blank"
                                                                        href="http://ujian.idolapppk.com/?id_user={{ session('id_pengguna') }}&id_paket={{ $id_paket ?? 0 }}&id_fasilitas={{ $fasilitas->id }}&id_tryout={{ $fasilitas->id_tryout ?? 0 }}"><i
                                                                            class="ri-external-link-line"></i></a></span>
                                                            </div>
                                                        </div>
                                                    @endif
                                            @endforeach
                                            <div class="row pt-1">
                                                <div class="col-10">
                                                    <p class="text-secondary">Hasil Tryout</p>
                                                </div>
                                                <div class="col-2">
                                                    <span class="float-end"><a class="btn bg-[#9e6925] text-white  btn-sm"
                                                            href="{{ route('frontend.service.hasilTryOut') }}"><i
                                                                class="ri-external-link-line"></i></a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">{{ $item->tanggal_akhir }}</small>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @else
                            <div class="col-lg-12 text-center">
                                <h2>Belum Ada Paket Belajar</h2>
                                <img src="{{ asset('frontend/baru/images/no-paket.svg') }}" alt="" class="mb-3"
                                    style="max-width:23em;">

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<script>
    function change(type) {
        $('.paket').each(function (index, element) {
            $(this).hide()
        });

        $('.'+type).each(function (index, element) {
            $(this).show()
        });

        let list = ["mandiri", "bimbel"]

        for (let i = 0; i < list.length; i++) {
            const e = list[i];
            $('#'+e).removeClass('bg-[#9e6925]');
            $('#'+e).removeClass('text-white');
        }
        $('#'+type).addClass('bg-[#9e6925]');
        $('#'+type).addClass('text-white');
    }
    document.addEventListener("DOMContentLoaded", function(event) {
        change('mandiri')
    });


</script>

