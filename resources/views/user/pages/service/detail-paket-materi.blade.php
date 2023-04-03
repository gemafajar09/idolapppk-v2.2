@extends('user.layout.app')
@section('title', 'IdolaPPPK - Detail Paket')

@section('content')
<div class="pagetitle">
    <h1>Detail Materi</h1>

</div>

<section class="section dashboard">
    <div class="row">
      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
          <div class="col-md-12">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-lg-12 mt-3">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                @php
                                  $hash = Request::segment(3);
                                @endphp
                                @php
                                    $tmp = "";
                                @endphp
                                @foreach ($kategori_materi as $key => $item)

                                @php
                                    if($key == 0) {
                                        $tmp = $item->id_kategori_materi;
                                    }
                                @endphp
                                 @php
                                 $url = '';
                                 if ($tipe_materi == 2) {
                                     $url = 'frontend.service.materiPaketSayaDetail';
                                 } elseif ($tipe_materi == 1) {
                                     $url = 'frontend.service.materiPaketSayaPdfDetail';
                                 } else {
                                     $url = 'frontend.service.materiPaketSayaDetail';
                                 }
                             @endphp

                                <li class="nav-item" role="presentation">
                                  <a class="nav-link {{ Request::segment(4) == $item->id_kategori_materi ? 'active' : ''}}" href="{{ route($url, ['id_paket' => $hash, 'id_kategori' => $item->id_kategori_materi ]) }}"style="cursor: pointer;">{{ $item->nama_kategori }}</a>
                                </li>
                                @endforeach
                              </ul>
                              <div class="tab-content">
                                <div>
                                    @php
                                    $idpaket = \App\Helper\HashHelper::decryptArray(Request::segment(3));
                                    if(Request::segment(4) == null){
                                       $materi2 = DB::table('materis')->groupBy('slug')->where('id_kategori_materi', $tmp)->where('id_paket', $idpaket)->where('type', $tipe_materi)->get();
                                    }else{
                                        $materi2 = DB::table('materis')->where('id_kategori_materi', Request::segment(4))->where('id_paket', $idpaket)->groupBy('slug')->where('type', $tipe_materi)->get();
                                    }
                                    @endphp

                            @foreach ($materi2 as $item)
                            <div class="card mb-3 shadow-none border" style="width: 100%;">
                            <div class="card-body d-flex">
                                <i class="bi bi-card-list" style="font-size: 46px;"></i>
                                <div class="ms-3">
                                    <h5 class="card-title">{{ $item->materi }}</h5>
                                    <p class="card-text">{{ $item->deskripsi_materi }}</p>
                                    @php
                                        $hash = Request::segment(3);
                                    @endphp

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
                                    <p class="card-text"><a href="{{ route($url, ["id_paket" => $hash, "slug" => $item->slug, "id_materi" => $item->id]) }}" class="btn btn-success">Lihat Materi</a></p>
                                </div>
                            </div>
                            </div>
                            @endforeach
                                </div>
                              </div>
                          </div>
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
@endsection

@push('addon-script')
@endpush
