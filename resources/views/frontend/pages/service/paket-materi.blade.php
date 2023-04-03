@extends('frontend.layout.index')

@section('content')
    @include('frontend.components.breadcumb', [
        'title' => 'Halaman Materi Paket Ultimate',
        'subtitle' => 'Materi',
    ])
    <!-- ======= Pricing Section ======= -->
    <section id="detail" class="materi">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4" data-aos="fade-left">
                <div class="col-lg-8 col-md-12 col-12 text-left" data-aos="zoom-in" data-aos-delay="200">
                    @if ($tipe_materi == 2)
                        <h3>Materi Video {{ $materi_tampil->materi }}</h3>
                        <div class="ratio ratio-16x9 shadow-sm p-3 bg-body rounded">
                            <iframe src="{{ $materi_tampil->file }}" title="YouTube video" allowfullscreen></iframe>
                        </div>
                    @elseif($tipe_materi == 1)
                        <h3>Materi Teks {{ $materi_tampil->materi }}</h3>
                        <div class="ratio ratio-1x1 shadow-sm p-3 bg-body rounded">
                            <object data='{{ asset("materi/$materi_tampil->file") }}' type="application/pdf">
                                <p>Alternative text - include a link <a href="{{asset('materi/$materi_tampil->file')}}">to the PDF!</a></p>
                            </object>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4 col-md-12 col-12 text-left" data-aos="zoom-in" data-aos-delay="200">
                    <div class="box">
                        <h3 style="text-align:center;" class="text-success"><i class="ri-video-fill"></i> List Materi</h3>
                        <hr>
                        <div class="ket-materi">
                            <ol class="list-group">
                                {{-- cek tipe_materi --}}
                                @php
                                    $url = '';
                                    if ($tipe_materi == 2) {
                                        $url = 'frontend.service.materiPaketSaya';
                                    } elseif ($tipe_materi == 1) {
                                        $url = 'frontend.service.materiPaketSayaPdf';
                                    } else {
                                        $url = 'frontend.service.materiPaketSaya';
                                    }
                                @endphp
                                {{-- end cek tipe --}}
                                @foreach ($list_materi as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"><i class="ri-list-check"></i>
                                                {{ $item['nama_materi'] }}</div>
                                            <ul style="list-style: none">
                                                @foreach ($item['data'] as $i => $value)
                                                    @php
                                                        $id_materi = App\Helper\HashHelper::encryptData($value->id);
                                                    @endphp
                                                    <a
                                                        href="{{ route($url, ['id_paket' => $parameter_paket, 'id_materi' => $id_materi]) }}">
                                                        <li><i class="ri-checkbox-circle-fill"></i> {{ $value->materi }}
                                                            {{ $i + 1 }}</li>
                                                    </a>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <span class="badge bg-success rounded-pill">{{ count($item['data']) }}</span>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('addon-script')
@endpush
