@extends('frontend.layout.index')

@section('content')
    @include('frontend.components.breadcumb', [
        'title' => 'Halaman Paket Saya',
        'subtitle' => 'Paket',
    ])
    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="paket-saya">

        <div class="container" data-aos="fade-up">

            <div class="row gy-4" data-aos="fade-left">
                @if (count($paket) > 0)
                    @foreach ($paket as $item)
                        @php
                            $data = [
                                'id_paket' => $item->id_paket,
                                'id_detail' => $item->id,
                            ];
                            $id_paket = App\Helper\HashHelper::encryptArray($data);
                            $id_paket_ujian = App\Helper\HashHelper::encryptData($item->id_paket); 
                        @endphp
                        <div class="col-lg-4 col-12">
                            <div class="card h-100 pt-4">
                                <img src="{{ asset('frontend/baru/images/hello.svg') }}" class="card-img-top" alt="...">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $item->paket->nama_paket }}</h5>
                                    <p class="card-text">{{ $item->paket->deskripsi_paket }}</p>
                                </div>
                                <div class="card-body">
                                    @foreach ($item->paket->fasilitas as $fasilitas)
                                        <div class="row">
                                            @if ($fasilitas->tipe_fasilitas == 'Materi Video')
                                                <div class="col-10">
                                                    <p>{{ $fasilitas->nama_fasilitas }}</p>
                                                </div>
                                                <div class="col-2">
                                                    <span class="float-end"><a class="btn btn-success btn-sm"
                                                            href="{{ route('frontend.service.materiPaketSaya', $id_paket) }}"><i
                                                                class="ri-external-link-line"></i></a></span>
                                                </div>
                                            @elseif($fasilitas->tipe_fasilitas == 'Materi PDF')
                                            <div class="col-10">
                                                <p>{{ $fasilitas->nama_fasilitas }}</p>
                                            </div>
                                            <div class="col-2">
                                                <span class="float-end"><a class="btn btn-success btn-sm"
                                                        href="{{ route('frontend.service.materiPaketSayaPdf', $id_paket) }}"><i
                                                            class="ri-external-link-line"></i></a></span>
                                            </div>
                                            @elseif($fasilitas->tipe_fasilitas == 'Ujian')
                                            <div class="col-10">
                                                <p>{{ $fasilitas->nama_fasilitas }}</p>
                                            </div>
                                            <div class="col-2">
                                                <span class="float-end"><a class="btn btn-success btn-sm"
                                                        href="{{route('ujian',$id_paket_ujian)}}"><i
                                                            class="ri-external-link-line"></i></a></span>
                                            </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">{{ $item->tanggal_akhir }}</small>
                                </div>
                            </div>
                        </div>
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

    </section>
    <!-- End Pricing Section -->
@endsection
