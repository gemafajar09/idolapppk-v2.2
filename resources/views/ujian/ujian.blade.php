@extends('ujian.template')
@section('mainclient')
    <form method="POST"
        action="{{ url('/ujian/simpan-ujian/' . App\Helper\HashHelper::encryptData($id_ujian) . '/' . App\Helper\HashHelper::encryptData($id_paket) . '/' . App\Helper\HashHelper::encryptData($id_fasilitas)) }}"
        id="form-simpan">
        @csrf
        <div class="container-fluid" style="margin-top:-35px">
            <div class="row justify-content-center">
                {{-- nama peserta ujian --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-left">
                                {{-- Nama Peserta : {{ Session('nama') }} --}}
                            </div>
                            <div class="float-right">
                                <button type="button"
                                    onclick="reportsoal('{{ $soal->id_soal }}', '{{ $soal->id_paket }}','{{ $id_fasilitas }}')"
                                    class="btn btn-info"><i class="fa fa-cog">&nbsp;Report
                                        Soal</i></button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- jawaban --}}
                <div class="col-md-12">
                    <div class="card" style="border-radius: 0">
                        <div class="card-body">
                            <div class="float-left">
                                <h5>SOAL NO :
                                    <span class="btn w3-deep-purple text-white"
                                        style="border-radius: 15px;">{{ $no }}</span>
                                </h5>
                            </div>
                            <div class="float-right">
                                Text Font :
                                <button type="button" onclick="myFunctionA()" class="btn btn-default">30%</button>
                                <button type="button" onclick="myFunctionAA()" class="btn btn-default">70%</button>
                                <button type="button" onclick="myFunctionAAA()" class="btn btn-default">85%</button>
                                <button type="button" onclick="myFunctionAAAA()" class="btn btn-default">100%</button>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div style="border:3px solid #dfdfdf; border-radius: 2px;padding: 20px;" id="myP">
                                <h4><b>{{ $soal->kategori }}</b></h4>
                                <hr>
                                @if ($soal->gambar != null)
                                    <img src="{{ asset('/') }}upload/soal/img/{{ $soal->gambar }}" style="width:50%"
                                        alt="">
                                @endif
                                <p>
                                    {!! $soal->soal !!}
                                </p>
                                <p>

                                <div class="col-md-12">
                                    <div>
                                        <input type="radio" <?= $jawaban['jawaban'] == 'a' ? 'checked' : '' ?>
                                            class="radio-custom-a" id="a" name="jawaban" value="a">
                                        <label class="radio-custom-label-a" for="a">
                                            {!! ltrim($soal->a) !!}
                                        </label>
                                    </div>
                                    <div class="">
                                        <input type="radio" <?= $jawaban['jawaban'] == 'b' ? 'checked' : '' ?>
                                            class="radio-custom-b" id="b" name="jawaban" value="b">
                                        <label class="radio-custom-label-b" for="b">
                                            {!! ltrim($soal->b) !!}
                                        </label>
                                    </div>
                                    <div class="">
                                        <input type="radio" <?= $jawaban['jawaban'] == 'c' ? 'checked' : '' ?>
                                            class="radio-custom-c" id="c" name="jawaban" value="c">
                                        <label class="radio-custom-label-c" for="c">
                                            {!! ltrim($soal->c) !!}
                                        </label>
                                    </div>
                                    <div class="">
                                        <input type="radio" <?= $jawaban['jawaban'] == 'd' ? 'checked' : '' ?>
                                            class="radio-custom-d" id="d" name="jawaban" value="d">
                                        <label class="radio-custom-label-d" for="d">
                                            {!! ltrim($soal->d) !!}
                                        </label>
                                    </div>
                                    @if ($soal->e != '')
                                        <div class="">
                                            <input type="radio" <?= $jawaban['jawaban'] == 'e' ? 'checked' : '' ?>
                                                class="radio-custom-e" id="e" name="jawaban" value="e">
                                            <label class="radio-custom-label-e" for="e">
                                                {!! ltrim($soal->e) !!}
                                            </label>
                                        </div>
                                    @endif
                                </div>
                                </p>
                            </div>
                            {{-- button disini --}}
                            <br>
                            <div class="row">
                                <div class="col-md-2 py-1">
                                    <button type="button" onclick="sebelum()" class="btn btn-primary btn-block">
                                        Simpan dan Lanjutkan
                                    </button>

                                </div>
                                <div class="col-md-2 py-1">
                                    <button type="button" onclick="berikut()" class="btn btn-primary btn-block">
                                        Lewatkan soal ini
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- pagination --}}
                <?php
                if ($_GET['page'] != 7) {
                    $pagenext = $_GET['page'] + 1;
                    $pageprev = $_GET['page'] != 1 ? $_GET['page'] - 1 : 1;
                } else {
                    $pagenext = $_GET['page'];
                    $pageprev = $_GET['page'] - 1;
                }
                ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- desktop --}}
                            <div class="row" id="desktop">
                                <div class="col-md-12" style="text-center">
                                    <div class="float-left" style="margin-top:30px">
                                        <a href="?page={{ $pageprev }}" style="font-size:30px; border-radius:30px"
                                            class="btn btn-rounded btn-info">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </div>
                                    <div class="float-right" style="margin-top:30px">
                                        <a href="?page={{ $pagenext }}" style="font-size:30px; border-radius:30px"
                                            class="btn btn-rounded btn-info">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                {{-- no soal --}}
                                <div class="col-md-8 mx-auto">
                                    <div class="row">
                                        @foreach ($soallist as $i => $a)
                                            @php
                                                $cekbutton = DB::table('jawabans')
                                                    ->where('id_user', $id_user)
                                                    ->where('id_paket', $id_paket)
                                                    ->where('id_ujian', $id_ujian)
                                                    ->where('id_fasilitas', $id_fasilitas)
                                                    ->where('no_soal', $a->no_soal)
                                                    ->first();
                                            @endphp

                                            @if (@count($cekbutton) > 0)
                                                @if ($cekbutton->ragu_ragu == '1')
                                                    @if ($a->no_soal == $cekbutton->no_soal)
                                                        <div class="col-md-1" style="margin-top:15px;">
                                                            <a style="width:100%"
                                                                class="w3-button w3-red w3-border w3-border-red w3-round w3-padding-large"
                                                                href="{{ url(
                                                                    '/ujian/start/' .
                                                                        App\Helper\HashHelper::encryptData($id_ujian) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_paket) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_fasilitas) .
                                                                        '/' .
                                                                        $a->no_soal .
                                                                        '?page=' .
                                                                        $_GET['page'],
                                                                ) }}">
                                                                <b
                                                                    style="margin-left :-10px !important">{{ $a->no_soal }}</b>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="col-md-1" style="margin-top:15px;">
                                                            <a style="width:100%"
                                                                class="w3-button w3-red w3-border w3-border-red w3-round w3-padding-large"
                                                                href="{{ url(
                                                                    '/ujian/start/' .
                                                                        App\Helper\HashHelper::encryptData($id_ujian) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_paket) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_fasilitas) .
                                                                        '/' .
                                                                        $a->no_soal .
                                                                        '?page=' .
                                                                        $_GET['page'],
                                                                ) }}">
                                                                <b
                                                                    style="margin-left :-10px !important">{{ $a->no_soal }}</b>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @else
                                                    @if ($a->no_soal == $soal->no_soal)
                                                        <div class="col-md-1" style="margin-top:15px;">
                                                            <a style="width:100%"
                                                                class="w3-button w3-green w3-border w3-border-green w3-round w3-padding-large"
                                                                href="{{ url(
                                                                    '/ujian/start/' .
                                                                        App\Helper\HashHelper::encryptData($id_ujian) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_paket) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_fasilitas) .
                                                                        '/' .
                                                                        $a->no_soal .
                                                                        '?page=' .
                                                                        $_GET['page'],
                                                                ) }}">
                                                                <b
                                                                    style="margin-left :-10px !important">{{ $a->no_soal }}</b>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="col-md-1" style="margin-top:15px;">
                                                            <a style="width:100%"
                                                                class="w3-button w3-green w3-border w3-border-green w3-round w3-padding-large"
                                                                href="{{ url(
                                                                    '/ujian/start/' .
                                                                        App\Helper\HashHelper::encryptData($id_ujian) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_paket) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_fasilitas) .
                                                                        '/' .
                                                                        $a->no_soal .
                                                                        '?page=' .
                                                                        $_GET['page'],
                                                                ) }}">
                                                                <b
                                                                    style="margin-left :-10px !important">{{ $a->no_soal }}</b>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endif
                                            @else
                                                <div class="col-md-1" style="margin-top:15px;">
                                                    <a style="width:100%"
                                                        class="w3-button w3-red w3-border w3-border-red w3-round w3-padding-large"
                                                        href="{{ url(
                                                            '/ujian/start/' .
                                                                App\Helper\HashHelper::encryptData($id_ujian) .
                                                                '/' .
                                                                App\Helper\HashHelper::encryptData($id_paket) .
                                                                '/' .
                                                                App\Helper\HashHelper::encryptData($id_fasilitas) .
                                                                '/' .
                                                                $a->no_soal .
                                                                '?page=' .
                                                                $_GET['page'],
                                                        ) }}">
                                                        <b style="margin-left :-10px !important">{{ $a->no_soal }}</b>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top:15px;">
                                    <button type="button" class="btn btn-primary btn-block"><span
                                            id="demo">Loading...</span>
                                    </button>
                                </div>
                            </div>

                            {{-- mobile --}}
                            <div class="row" id="mobile">
                                <div class="navigatorPagin col-md-12">
                                    <div class="prev">
                                        <a href="?page={{ $pageprev }}" style="font-size:20px"
                                            class="btn btn-rounded btn-info"><i class="fa fa-angle-left"></i></a>
                                    </div>
                                    <div class="nexts">
                                        <a href="?page={{ $pagenext }}" style="font-size:20px"
                                            class="btn btn-rounded btn-info"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12" style="margin-top:10px; text-align:center ">
                                    <div class="row">
                                        @foreach ($soallist as $i => $a)
                                            @php
                                                $cekbutton = DB::table('jawabans')
                                                    ->where('id_user', $id_user)
                                                    ->where('id_paket', $id_paket)
                                                    ->where('id_ujian', $id_ujian)
                                                    ->where('no_soal', $a->no_soal)
                                                    ->first();
                                            @endphp

                                            @if (@count($cekbutton) > 0)
                                                @if ($cekbutton->ragu_ragu == '1')
                                                    @if ($a->no_soal == $cekbutton->no_soal)
                                                        <div class="" style="margin-top:15px; width:25%;">
                                                            <a style="width:100%"
                                                                class="
                                                              w3-button w3-red w3-border w3-border-red w3-round w3-padding-large"
                                                                href="{{ url(
                                                                    '/ujian/start/' .
                                                                        App\Helper\HashHelper::encryptData($id_ujian) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_paket) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_fasilitas) .
                                                                        '/' .
                                                                        $a->no_soal .
                                                                        '?page=' .
                                                                        $_GET['page'],
                                                                ) }}">
                                                                <b>{{ $a->no_soal }}</b>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="" style="margin-top:15px; width:25%;">
                                                            <a style="width:100%"
                                                                class="w3-button w3-red w3-border w3-border-red w3-round w3-padding-large"
                                                                href="{{ url(
                                                                    '/ujian/start/' .
                                                                        App\Helper\HashHelper::encryptData($id_ujian) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_paket) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_fasilitas) .
                                                                        '/' .
                                                                        $a->no_soal .
                                                                        '?page=' .
                                                                        $_GET['page'],
                                                                ) }}">
                                                                <b>{{ $a->no_soal }}</b>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @else
                                                    @if ($a->no_soal == $soal->no_soal)
                                                        <div class="" style="margin-top:15px; width:25%;">
                                                            <a style="width:100%"
                                                                class="w3-button w3-red w3-border w3-border-red w3-round w3-padding-large"
                                                                href="{{ url(
                                                                    '/ujian/start/' .
                                                                        App\Helper\HashHelper::encryptData($id_ujian) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_paket) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_fasilitas) .
                                                                        '/' .
                                                                        $a->no_soal .
                                                                        '?page=' .
                                                                        $_GET['page'],
                                                                ) }}">
                                                                <b>{{ $a->no_soal }}</b>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="" style="margin-top:15px; width:25%;">
                                                            <a style="width:100%"
                                                                class="w3-button w3-green w3-border w3-border-green w3-round w3-padding-large"
                                                                href="{{ url(
                                                                    '/ujian/start/' .
                                                                        App\Helper\HashHelper::encryptData($id_ujian) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_paket) .
                                                                        '/' .
                                                                        App\Helper\HashHelper::encryptData($id_fasilitas) .
                                                                        '/' .
                                                                        $a->no_soal .
                                                                        '?page=' .
                                                                        $_GET['page'],
                                                                ) }}">
                                                                <b>{{ $a->no_soal }}</b>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endif
                                            @else
                                                <div class="" style="margin-top:15px; width:25%;">
                                                    <a style="width:100%"
                                                        class="w3-button w3-red w3-border w3-border-red w3-round w3-padding-large"
                                                        href="{{ url(
                                                            '/ujian/start/' .
                                                                App\Helper\HashHelper::encryptData($id_ujian) .
                                                                '/' .
                                                                App\Helper\HashHelper::encryptData($id_paket) .
                                                                '/' .
                                                                App\Helper\HashHelper::encryptData($id_fasilitas) .
                                                                '/' .
                                                                $a->no_soal .
                                                                '?page=' .
                                                                $_GET['page'],
                                                        ) }}">
                                                        <b>{{ $a->no_soal }}</b>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-12" style="margin-top:10px">
                                    <button type="button" style="width: inherit;"
                                        class="btn btn-primary btn-block demo"><span id="">Loading...</span> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br><br>
        {{-- @dd($soal->kategori) --}}
        <input type="hidden" name="no" value="{{ $no }}">
        <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
        <input type="hidden" name="kategori" value="{{ $soal->kategori }}">
        <input type="hidden" name="id_jawaban" id="id_jawaban" value="{{ $jawaban['id'] }}">
        <input type="hidden" name="aksi" id="aksi">

        <!-- The Modal -->
        <div class="modal" id="finish">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Test</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <i class="fa fa-warning" style="margin-top:20px;margin-left: 15px;font-size:52px;"></i>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        Apakah anda yakin ingin mengakhiri ujian ini? <br>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 12px;">
                                        <div class="row">

                                            <div class="col-md-2 ">
                                                <input type="checkbox" id="customCheck" name="setuju"
                                                    onchange="document.getElementById('sendNewSms').disabled = !this.checked;"
                                                    style="margin-top:20px;margin-left: 15px;">
                                            </div>
                                            <div class="col-md-10">
                                                <center>
                                                    Centang, Kemudian tekan tombol selesai. <br>
                                                    anda tidak akan bisa kembali ke soal jika sudah menekan tombol selesai
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer1">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" onclick="akhir()" id="sendNewSms" name="selesai" value="selesai"
                                    class="btn btn-success btn-block" disabled>Selesai</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <form id="waktu-habis"
        action="{{ url('ujian/ujian-finis/' . session('id_pengguna') . '/' . App\Helper\HashHelper::encryptData($id_paket) . '/' . App\Helper\HashHelper::encryptData($id_ujian) . '/' . App\Helper\HashHelper::encryptData($id_fasilitas)) }}"
        method="POST" style="display: none;">
        @csrf
    </form>

    <div class="modal" id="reportSoal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Report Soal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('report-soal') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Kategori Laporan</label>
                            <select name="kategori_laporan" id="kategori_laporan" class="form-control">
                                <option value="">-PILIH-</option>
                                <option value="Soal tidak tepat">Soal tidak tepat</option>
                                <option value="Salah ketik pada soal">Salah ketik pada soal</option>
                                <option value="Pilihan jawaban tidak sesuai">Pilihan jawaban tidak sesuai</option>
                                <option value="Kunci jawaban tidak tepat">Kunci jawaban tidak tepat</option>
                                <option value="Pembahasan tidak sesuai">Pembahasan tidak sesuai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Laporan</label>
                            <textarea name="laporan" id="laporan" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <input type="hidden" name="id_paket" id="id_paketx">
                        <input type="hidden" name="id_fasilitas" id="id_fasilitasx">
                        <input type="hidden" name="id_soal" id="id_soalx">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @include('ujian.menu.script')

    <script>
        function sebelum() {
            document.getElementById('aksi').value = 'sebelumnya'
            document.getElementById("form-simpan").submit();
        }

        function berikut() {
            document.getElementById('aksi').value = 'berikutnya'
            document.getElementById("form-simpan").submit();
        }

        function akhir() {
            document.getElementById('aksi').value = 'finish'
            document.getElementById("form-simpan").submit();
        }

        function finish() {
            $('#finish').modal('show')
        }

        function reportsoal(id_soal, id_paket, id_fasilitas) {
            $('#id_soalx').val(id_soal);
            $('#id_paketx').val(id_paket);
            $('#id_fasilitasx').val(id_fasilitas);
            $('#reportSoal').modal('show')
        }
    </script>
@endsection
