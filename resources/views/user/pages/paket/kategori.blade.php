@extends('user.layout.app')
@section('title', 'IdolaPPPK - Paket Tersedia')

@section('content')
<div class="pagetitle container">
    <h1>Paket Tersedia</h1>
</div>

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12 container mt-3">
          <div class="row">
              <div class="col-md-12">
                  <div class="row mb-3">
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
                      @foreach ($paket as $item)
                        <div class="col-lg-4 col-md-6 paket {{ $item->type }}" data-aos="zoom-in" data-aos-delay="100">
                            <div class="card shadow rounded-lg">
                                <div class="card-body">
                                    <img src='{{asset($item->banner)}}'>
                                    <h5 style="color: black;" class="mt-3 text-xl font-semibold">{{ $item->nama }}</h5>
                                    <div class="text-right">
                                        <s class="text-lg font-semibold text-red-500">Rp. {{$item->harga_coret}},-</s>
                                        <span class="text-lg font-semibold">Rp. {{$item->harga_paket}},-</span>
                                    </div>
                                    <a href="{{ route('frontend.paketKategoriDetail', [$item->id_kategori_paket, $item->type]) }}" class="btn border-[#9e6925] hover:bg-white hover:!text-[#9e6925] text-white bg-[#9e6925] mt-2 flex items-center gap-2">
                                        <i class='bx bxs-cart text-2xl' ></i>
                                        Lihat Paket
                                    </a>
                                </div>
                            </div>
                        </div>
                      @endforeach
                  </div>
              </div>
          </div>
      </div>

    </div>
  </section>
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
