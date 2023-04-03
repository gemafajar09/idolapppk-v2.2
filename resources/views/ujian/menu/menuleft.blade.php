<div id="myNav" class="overlay w3-card-4" style="border-top-left-radius: 15px; border-bottom-left-radius:15px">

    <header>
        <a href="javascript:void(0)" class="w3-btn w3-block"
            style="background-color: #dbb258; color:white;border-top-left-radius: 15px;" onclick="closeNav()"><i
                class="fa fa-arrow-right"></i>
            Back</a>
    </header>

    <div class="overlay-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="container-fluid">
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
                                    @if ($cekbutton->ragu_ragu == 'ragu-ragu')
                                        @if ($a->no_soal == $cekbutton->no_soal)
                                            <div class="col-md-3"
                                                style="margin-top:15px;  padding-right: 5px;padding-left: 5px;">
                                                <a class="w3-button w3-yellow w3-border w3-border-yellow w3-round w3-padding-large"
                                                    href="{{ url('/ujian/start/' . base64_encode($id_ujian) . '/' . base64_encode($id_paket) . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b></a><span
                                                    class="w3-badge badge-style  w3-white"><b>{{ $cekbutton->jawaban }}
                                                    </b></span>
                                            </div>
                                        @else
                                            <div class="col-md-3"
                                                style="margin-top:15px;  padding-right: 5px;padding-left: 5px;">
                                                <a class="w3-button w3-yellow w3-border w3-border-yellow w3-round w3-padding-large"
                                                    href="{{ url('/ujian/start/' . base64_encode($id_ujian) . '/' . base64_encode($id_paket) . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b></a><span
                                                    class="w3-badge  w3-white badge-style"><b>A{{ $cekbutton->jawaban }}</b></span>
                                            </div>
                                        @endif
                                    @else
                                        @if ($a->no_soal == $soal->no_soal)
                                            <div class="col-md-3"
                                                style="margin-top:15px;  padding-right: 5px;padding-left: 5px;">
                                                <a class="w3-button w3-red w3-border w3-border-red w3-round w3-padding-large"
                                                    href="{{ url('/ujian/start/' . base64_encode($id_ujian) . '/' . base64_encode($id_paket) . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b></a><span
                                                    class="w3-badge badge-style  w3-white"><b>{{ $cekbutton->jawaban }}</b></span>
                                            </div>
                                        @else
                                            <div class="col-md-3"
                                                style="margin-top:15px;  padding-right: 5px;padding-left: 5px;">
                                                <a class="w3-button w3-blue w3-border w3-border-blue w3-round w3-padding-large"
                                                    href="{{ url('/ujian/start/' . base64_encode($id_ujian) . '/' . base64_encode($id_paket) . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b></a><span
                                                    class="w3-badge badge-style  w3-white"><b>{{ $cekbutton->jawaban }}</b></span>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    <div class="col-md-3"
                                        style="margin-top:15px;  padding-right: 5px;padding-left: 5px;">
                                        <a class="w3-button w3-khaki w3-border w3-border-khaki w3-round w3-padding-large"
                                            href="{{ url('/ujian/start/' . base64_encode($id_ujian) . '/' . base64_encode($id_paket) . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b></a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <br><br>
                </div>

            </div>
        </div>
    </div>
</div>
