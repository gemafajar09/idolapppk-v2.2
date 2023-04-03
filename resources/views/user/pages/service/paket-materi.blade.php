@extends('user.layout.app')
@section('title', 'IdolaPPPK - Materi Paket')

@section('content')
 <style>
      #canvas_container {
          width: 100%;
          height:100%;
          overflow: auto;
      }

      #canvas_container {
        text-align: center;
      }
  </style>

<div class="pagetitle">
    <h1>Materi</h1>

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
                      <div class="card-body p-3">
                          <div class="row">
                            <div class="col-lg-8 col-md-12 col-12 text-left" data-aos="zoom-in" data-aos-delay="200">
                                @if ($tipe_materi == 2)
                                    <h4>Materi Video : {{ $materi_tampil->materi }}</h4>
                                    <div class="ratio ratio-16x9 shadow-sm p-3 bg-body rounded">
                                        <iframe src="{{ $materi_tampil->file }}" title="YouTube video" allowfullscreen></iframe>
                                    </div>
                                @elseif($tipe_materi == 1)
                                    <h3>Materi Teks : {{ $materi_tampil->materi }}</h3>
                                    <a href="{{ asset('materi/$materi_tampil->file') }}" class="btn btn-info text-white">
                                        Donwload
                                    </a>
                                    <div class="shadow-sm p-3 rounded">
                                        <!--<object width="100" data='{{ asset("materi/$materi_tampil->file") }}' type="application/pdf">-->
                                        <!--    <p>Alternative text - include a link <a href="{{asset('materi/$materi_tampil->file')}}">to the PDF!</a></p>-->
                                        <!--</object>-->
                                        <div id="my_pdf_viewer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="canvas_container">
                                                        <canvas id="pdf_renderer"></canvas>
                                                    </div>
                                                </div>

                                                <div class="col-md-8 mb-2 mt-2">
                                                    <div id="navigation_controls">
                                                        <div class="d-flex">
                                                            <div class="">
                                                                <button class="btn" style="width: 80px;height: 38px;background: #8b694d;color: white;margin-right: 6px;" id="go_previous">Previous</button>
                                                            </div>
                                                            <div class="">
                                                                <input style="width:60px;" id="current_page" class="form-control" value="1" readonly type="number"/>
                                                            </div>
                                                            <div class="">
                                                                <button class="btn" style="width: 80px;height: 38px;background: #8b694d;color: white;margin-left: 6px;" id="go_next">Next</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-2">

                                                    <div id="zoom_controls">
                                                        <button class="btn" style="width: 80px;height: 38px;background: #8b694d;color: white;margin-left: 6px;" id="zoom_in">
                                                            <i class="bi bi-zoom-in"></i></i>
                                                        </button>
                                                        <button class="btn" style="width: 80px;height: 38px;background: #8b694d;color: white;margin-left: 6px;"  id="zoom_out">
                                                            <i class='bi bi-zoom-out'></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-lg-4 col-md-12 col-12 text-left">
                                <div class="box">
                                    <h4 style="text-align:center;" class="text-success"><i class="ri-video-fill"></i> List Materi</h4>
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
                                                                <a
                                                                    href="{{ route($url, ['id_paket' => $parameter_paket, 'slug'=> $value->slug, 'id_materi' => $value->id]) }}">
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
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
</script>


<script>
        var w = window.innerWidth;
        var h = window.innerHeight;

        if(w > 560)
        {
            var myState = {
                pdf: null,
                currentPage: 1,
                zoom: 1
            }

        }else{
            var myState = {
                pdf: null,
                currentPage: 1,
                zoom: 0.5
            }
        }


        pdfjsLib.getDocument('{{ asset("materi/$materi_tampil->file") }}').then((pdf) => {

            myState.pdf = pdf;
            render();

        });

        function render() {
            myState.pdf.getPage(myState.currentPage).then((page) => {

                var canvas = document.getElementById("pdf_renderer");
                var ctx = canvas.getContext('2d');

                var viewport = page.getViewport(myState.zoom);

                canvas.width = viewport.width;
                canvas.height = viewport.height;

                page.render({
                    canvasContext: ctx,
                    viewport: viewport
                });
            });
        }

        document.getElementById('go_previous').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage == 1)
              return;
            myState.currentPage -= 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });

        document.getElementById('go_next').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages)
               return;
            myState.currentPage += 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });

        document.getElementById('current_page').addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;

            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);

            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage =
                document.getElementById('current_page').valueAsNumber;

                if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                    myState.currentPage = desiredPage;
                    document.getElementById("current_page").value = desiredPage;
                    render();
                }
            }
        });

        document.getElementById('zoom_in').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            myState.zoom += 0.5;
            render();
        });

        document.getElementById('zoom_out').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            myState.zoom -= 0.5;
            render();
        });
    </script>
@endsection

@push('addon-script')
@endpush
