@extends('ujian.template')
@section('mainclient')
    <div class="container-fluid" style="margin-top:-35px">
        <div class="row justify-content-center">
            {{-- jawaban --}}
            <div class="col-md-9">
                <div class="card" style="border-radius: 0">
                    <div class="card-body">
                        @php
                            $cekjwb = DB::table('jawabans')
                                ->where('id_ujian', $id_ujian)
                                ->where('id_paket', $id_paket)
                                ->where('id_fasilitas', $id_fasilitas)
                                ->where('no_soal', $soal->no_soal)
                                ->where('id_user', session('id_pengguna'))
                                ->first();

                        @endphp
                        <div style="border:3px solid #dfdfdf; border-radius: 2px;padding: 20px;" id="myP">
                            <div class="float-left">
                                <h6><b>SOAL NOMOR : {{ $no }} </b>
                                    @if ($jawaban == 1)
                                        <span
                                            style="background-color:green; color:white; padding:5px; border-radius:5px;">Benar</span>
                                    @elseif($jawaban == 2)
                                        <span
                                            style="background-color:red; color:white; padding:5px; border-radius:5px;">Salah</span>
                                    @elseif($jawaban == 0)
                                        <span
                                            style="background-color:grey; color:white; padding:5px; border-radius:5px;">Belum
                                            Dijawab</span>
                                    @endif
                                </h6>

                            </div>
                            <div class="float-right">
                                <button type="button"
                                    onclick="reportsoal('{{ $soal->id_soal }}', '{{ $soal->id_paket }}','{{ $id_fasilitas }}')"
                                    class="btn btn-danger">Report Soal</button>
                            </div>
                            <br>
                            <hr>
                            <p>
                            <h6><b>{{ $soal->kategori }}</b></h6>
                            @if ($soal->gambar != null)
                                <img src="{{ asset('/') }}upload/soal/img/{{ $soal->gambar }}" style="width:50%"
                                    alt="">
                                <br>
                            @endif
                            {!! $soal->soal !!}
                            </p>
                            <p>
                                @php
                                    $jwbnBnr = '';
                                    if ($kategori[0] == $soal->kategori) {
                                        if ($soal->jawaban_a == 5) {
                                            $jwbnBnr = 'a';
                                        } elseif ($soal->jawaban_b == 5) {
                                            $jwbnBnr = 'b';
                                        } elseif ($soal->jawaban_c == 5) {
                                            $jwbnBnr = 'c';
                                        } elseif ($soal->jawaban_d == 5) {
                                            $jwbnBnr = 'd';
                                        } elseif ($soal->jawaban_e == 5) {
                                            $jwbnBnr = 'e';
                                        } else {
                                            $jwbnBnr = '';
                                        }
                                    }elseif($kategori[1] == $soal->kategori){
                                        if ($soal->jawaban_a == 4) {
                                            $jwbnBnr = 'a';
                                        } elseif ($soal->jawaban_b == 4) {
                                            $jwbnBnr = 'b';
                                        } elseif ($soal->jawaban_c == 4) {
                                            $jwbnBnr = 'c';
                                        } elseif ($soal->jawaban_d == 4) {
                                            $jwbnBnr = 'd';
                                        } else {
                                            $jwbnBnr = '';
                                        }
                                    }elseif($kategori[2] == $soal->kategori){
                                        if ($soal->jawaban_a == 5) {
                                            $jwbnBnr = 'a';
                                        } elseif ($soal->jawaban_b == 5) {
                                            $jwbnBnr = 'b';
                                        } elseif ($soal->jawaban_c == 5) {
                                            $jwbnBnr = 'c';
                                        } elseif ($soal->jawaban_d == 5) {
                                            $jwbnBnr = 'd';
                                        } elseif ($soal->jawaban_e == 5) {
                                            $jwbnBnr = 'e';
                                        } else {
                                            $jwbnBnr = '';
                                        }
                                    }elseif($kategori[3] == $soal->kategori){
                                        if ($soal->jawaban_a == 4) {
                                            $jwbnBnr = 'a';
                                        } elseif ($soal->jawaban_b == 4) {
                                            $jwbnBnr = 'b';
                                        } elseif ($soal->jawaban_c == 4) {
                                            $jwbnBnr = 'c';
                                        } elseif ($soal->jawaban_d == 4) {
                                            $jwbnBnr = 'd';
                                        } else {
                                            $jwbnBnr = '';
                                        }
                                    }
                                @endphp

                            <div class="col-md-12">
                                @if ($jwbnBnr != '')
                                    @if (isset($cekjwb->jawaban))
                                        @if ($jwbnBnr == 'a' && $cekjwb->jawaban == 'a')
                                            <div style="color:green">
                                                A.
                                                <label class="radio-custom-label-a" for="a">
                                                    {!! $soal->a !!}
                                                </label>
                                            </div>
                                        @elseif ($jwbnBnr == 'a')
                                            <div style="color:red">
                                                A.
                                                <label class="radio-custom-label-a" for="a">
                                                    {!! $soal->a !!}
                                                </label>
                                            </div>
                                        @elseif ($cekjwb->jawaban == 'a')
                                            <div style="color:blue">
                                                A.
                                                <label class="radio-custom-label-a" for="a">
                                                    {!! $soal->a !!}
                                                </label>
                                            </div>
                                        @else
                                            <div>
                                                A.
                                                <label class="radio-custom-label-a" for="a">
                                                    {!! $soal->a !!}
                                                </label>
                                            </div>
                                        @endif
                                    @else
                                        <div>
                                            A.
                                            <label class="radio-custom-label-a" for="a">
                                                {!! $soal->a !!}
                                            </label>
                                        </div>
                                    @endif

                                    @if (isset($cekjwb->jawaban))
                                        @if ($jwbnBnr == 'b' && $cekjwb->jawaban == 'b')
                                            <div style="color:green">
                                                B.
                                                <label class="radio-custom-label-a">
                                                    {!! $soal->b !!}
                                                </label>
                                            </div>
                                        @elseif ($jwbnBnr == 'b')
                                            <div style="color:red">
                                                B.
                                                <label class="radio-custom-label-a">
                                                    {!! $soal->b !!}
                                                </label>
                                            </div>
                                        @elseif ($cekjwb->jawaban == 'b')
                                            <div style="color:blue">
                                                B.
                                                <label class="radio-custom-label-a" for="a">
                                                    {!! $soal->b !!}
                                                </label>
                                            </div>
                                        @else
                                            <div>
                                                B.
                                                <label class="radio-custom-label-a">
                                                    {!! $soal->b !!}
                                                </label>
                                            </div>
                                        @endif
                                    @else
                                        <div>
                                            B.
                                            <label class="radio-custom-label-a">
                                                {!! $soal->b !!}
                                            </label>
                                        </div>
                                    @endif

                                    @if (isset($cekjwb->jawaban))
                                        @if ($jwbnBnr == 'c' && $cekjwb->jawaban == 'c')
                                            <div style="color:green">
                                                C.
                                                <label class="radio-custom-label-a">
                                                    {!! $soal->c !!}
                                                </label>
                                            </div>
                                        @elseif ($jwbnBnr == 'c')
                                            <div style="color:red">
                                                C.
                                                <label class="radio-custom-label-a">
                                                    {!! $soal->c !!}
                                                </label>
                                            </div>
                                        @elseif ($cekjwb->jawaban == 'c')
                                            <div style="color:blue">
                                                C.
                                                <label class="radio-custom-label-a">
                                                    {!! $soal->c !!}
                                                </label>
                                            </div>
                                        @else
                                            <div>
                                                C.
                                                <label class="radio-custom-label-a">
                                                    {!! $soal->c !!}
                                                </label>
                                            </div>
                                        @endif
                        
                                        
                                    @else
                                        <div>
                                            C.
                                            <label class="radio-custom-label-a">
                                                {!! $soal->c !!}
                                            </label>
                                        </div>
                                    @endif

                                    @if (isset($cekjwb->jawaban))
                                        @if ($jwbnBnr == 'd' && $cekjwb->jawaban == 'd')
                                            <div style="color:green">
                                                D.
                                                <label class="radio-custom-label-a">
                                                    {!! $soal->d !!}
                                                </label>
                                            </div>
                                        @elseif ($jwbnBnr == 'd')
                                            <div style="color:red">
                                                D.
                                                <label class="radio-custom-label-a">
                                                    {!! $soal->d !!}
                                                </label>
                                            </div>
                                        @elseif ($cekjwb->jawaban == 'd')
                                            <div style="color:blue">
                                                D.
                                                <label class="radio-custom-label-a">
                                                    {!! $soal->d !!}
                                                </label>
                                            </div>
                                        @else
                                            <div>
                                                D.
                                                <label class="radio-custom-label-a">
                                                    {!! $soal->d !!}
                                                </label>
                                            </div>
                                        @endif
                                    @else
                                        <div>
                                            D.
                                            <label class="radio-custom-label-a">
                                                {!! $soal->d !!}
                                            </label>
                                        </div>
                                    @endif

                                    @if($soal->e != "")
                                    
                                        @if (isset($cekjwb->jawaban))
                                            @if ($jwbnBnr == 'e' && $cekjwb->jawaban == 'e')
                                                <div style="color:green">
                                                    E.
                                                    <label class="radio-custom-label-a">
                                                        {!! $soal->e !!}
                                                    </label>
                                                </div>
                                            @elseif ($jwbnBnr == 'e')
                                                <div style="color:red">
                                                    E.
                                                    <label class="radio-custom-label-a">
                                                        {!! $soal->e !!}
                                                    </label>
                                                </div>
                                            @elseif ($cekjwb->jawaban == 'e')
                                                <div style="color:blue">
                                                    E.
                                                    <label class="radio-custom-label-a">
                                                        {!! $soal->e !!}
                                                    </label>
                                                </div>
                                            @else
                                                <div>
                                                    E.
                                                    <label class="radio-custom-label-a">
                                                        {!! $soal->e !!}
                                                    </label>
                                                </div>
                                            @endif
                                        @else
                                            <div>
                                                E.
                                                <label class="radio-custom-label-a">
                                                    {!! $soal->e !!}
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (isset($cekjwb->jawaban))
                                        <div style="color:
                                        <?= $cekjwb->jawaban == 'a' && $cekjwb->jawaban == 'a' ? 'green' : 
                                        $jwbnBnr == 'a' ? 'red' : $cekjwb->jawaban == 'a' ? 'blue' : '' ?>">
                                            A.
                                            <label class="radio-custom-label-a" for="a">
                                                {!! $soal->a !!}
                                            </label>
                                        </div>

                                        <div style="color:<?= $cekjwb->jawaban == 'b' && $cekjwb->jawaban == 'b' ? 'green' : 
                                        $jwbnBnr == 'b' ? 'red' : $cekjwb->jawaban == 'b' ? 'blue' : '' ?>">
                                            B.
                                            <label class="radio-custom-label-b" for="b">
                                                {!! $soal->b !!}
                                            </label>
                                        </div>

                                        <div style="color:<?= $cekjwb->jawaban == 'c' && $cekjwb->jawaban == 'c' ? 'green' : 
                                        $jwbnBnr == 'c' ? 'red' : $cekjwb->jawaban == 'c' ? 'blue' : '' ?>">
                                            C.
                                            <label class="radio-custom-label-c" for="c">
                                                {!! $soal->c !!}
                                            </label>
                                        </div>

                                        <div style="color:<?= $cekjwb->jawaban == 'd' && $cekjwb->jawaban == 'd' ? 'green' : 
                                        $jwbnBnr == 'd' ? 'red' : $cekjwb->jawaban == 'd' ? 'blue' : '' ?>">
                                            D.
                                            <label class="radio-custom-label-d" for="d">
                                                {!! $soal->d !!}
                                            </label>
                                        </div>

                                        @if ($soal->e != null)
                                            <div style="color:<?= $cekjwb->jawaban == 'e' && $cekjwb->jawaban == 'e' ? 'green' : 
                                        $jwbnBnr == 'e' ? 'red' : $cekjwb->jawaban == 'e' ? 'blue' : '' ?>">
                                                E.
                                                <label class="radio-custom-label-e" for="e">
                                                    {!! $soal->e !!}
                                                </label>
                                            </div>
                                        @endif
                                    @else
                                        <div>
                                            A.
                                            <label class="radio-custom-label-a" for="a">
                                                {!! $soal->a !!}
                                            </label>
                                        </div>

                                        <div>
                                            B.
                                            <label class="radio-custom-label-b" for="b">
                                                {!! $soal->b !!}
                                            </label>
                                        </div>

                                        <div>
                                            C.
                                            <label class="radio-custom-label-c" for="c">
                                                {!! $soal->c !!}
                                            </label>
                                        </div>

                                        <div>
                                            D.
                                            <label class="radio-custom-label-d" for="d">
                                                {!! $soal->d !!}
                                            </label>
                                        </div>

                                        @if ($soal->e != "")
                                            <div>
                                                E.
                                                <label class="radio-custom-label-e" for="e">
                                                    {!! $soal->e !!}
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                <br>
                            </div>

                            </p>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div style="border:3px solid #dfdfdf; border-radius: 2px;padding: 20px;">
                            {{-- cek berdasarkan kategori soal --}}
                            @if ($kategori[0] == $soal->kategori)
                                @if ($soal->jawaban_a == 5)
                                    @if (isset($cekjwb->jawaban))
                                        <p>
                                            <b style="color:blue; font-size:12px">JAWABAN ANDA :</b> <span
                                                style="text-transform: uppercase;"></span><?= $cekjwb->jawaban ?></span><br>
                                            <b style="color:red; font-size:12px">KUNCI JAWABAN:</b> A
                                        </p>
                                    @endif
                                    <hr>
                                    <i style="color:red">
                                        Jawaban : A. <?= $soal->a ?>
                                    </i>
                                @elseif($soal->jawaban_b == 5)
                                    @if (isset($cekjwb->jawaban))
                                        <p>
                                            <b style="color:blue; font-size:12px">JAWABAN ANDA :</b> <span
                                                style="text-transform: uppercase;"><?= $cekjwb->jawaban ?></span><br>
                                            <b style="color:red; font-size:12px">KUNCI JAWABAN:</b> B
                                        </p>
                                    @endif
                                    <hr>
                                    <i style="color:red">
                                        Jawaban : B. <?= $soal->b ?>
                                    </i>
                                @elseif($soal->jawaban_c == 5)
                                    @if (isset($cekjwb->jawaban))
                                        <p>
                                            <b style="color:blue; font-size:12px">JAWABAN ANDA :</b> <span
                                                style="text-transform: uppercase;"><?= $cekjwb->jawaban ?></span><br>
                                            <b style="color:red; font-size:12px">KUNCI JAWABAN:</b> C
                                        </p>
                                    @endif
                                    <hr>
                                    <i style="color:red">
                                        Jawaban : C. <?= $soal->c ?>
                                    </i>
                                @elseif($soal->jawaban_d == 5)
                                    @if (isset($cekjwb->jawaban))
                                        <p>
                                            <b style="color:blue; font-size:12px">JAWABAN ANDA :</b> <span
                                                style="text-transform: uppercase;"><?= $cekjwb->jawaban ?></span><br>
                                            <b style="color:red; font-size:12px">KUNCI JAWABAN:</b> D
                                        </p>
                                    @endif
                                    <hr>
                                    <i style="color:red">
                                        Jawaban : D. <?= $soal->d ?>
                                    </i>
                                @elseif($soal->a != "" && $soal->jawaban_e == 5)
                                    @if (isset($cekjwb->jawaban))
                                        <p>
                                            <b style="color:blue; font-size:12px">JAWABAN ANDA :</b> <span
                                                style="text-transform: uppercase;"><?= $cekjwb->jawaban ?></span><br>
                                            <b style="color:red; font-size:12px">KUNCI JAWABAN:</b> E
                                        </p>
                                    @endif
                                    <hr>
                                    <i style="color:red">
                                        Jawaban : E. <?= $soal->e ?>
                                    </i>
                                @endif

                                @if ($soal->pembahasan != null)
                                    <p>
                                        <b style="color:red">Pembahasan :</b> <?= $soal->pembahasan ?>
                                    </p>
                                @endif
                                <br>
                                <center>
                                    @if($soal->pembahasan_gambar != null)
                                        <img src="{{ asset('/') }}upload/soal/img/{{ $soal->pembahasan_gambar }}"
                                            style="width:50%" alt="">
                                    @endif
                                </center>  
                            @elseif($kategori[1] == $soal->kategori)
                                <div class="row">
                                    <div class="col-md-6  mx-auto">
                                        <table border="1px" class="table table-striped">
                                            <tr>
                                                <th style="width:10%">Level</th>
                                                <th style="width:45%">Deskripsi</th>
                                                <th style="width:45%">Indikator Pelaku</th>
                                            </tr>
                                            <tr>
                                                <td><?= $soal->level ?></td>
                                                <td><?= $soal->deskripsi ?></td>
                                                <td><?= $soal->indikator ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    @if ($soal->pembahasan != null)
                                        <p>
                                            <b style="color:red">Pembahasan :</b> <?= $soal->pembahasan ?>
                                        </p>
                                    @endif
                                    @if($soal->pembahasan_gambar != null)
                                        <img src="{{ asset('/') }}upload/soal/img/{{ $soal->pembahasan_gambar }}"
                                            style="width:50%" alt="">
                                    @endif
                                    <p>
                                        Bobot nilai jawaban berjenjang dari 1 hingga 4 poin dan 0 poin jika tidak menjawab.
                                        Urutan berdasarkan skala kematangan dari yang tertinggi (4) ke yang terendah (1)
                                        dapat dilihat pada tabel berikut:
                                    </p>
                                    <div class="col-md-6  mx-auto">
                                        <table border="1px" class="table table-striped text-center">
                                            <tr>
                                                <th style="width:25%">Nilai 4</th>
                                                <th style="width:25%">Nilai 3</th>
                                                <th style="width:25%">Nilai 2</th>
                                                <th style="width:25%">Nilai 1</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @if ($soal->jawaban_a == 4)
                                                        A
                                                    @elseif($soal->jawaban_b == 4)
                                                        B
                                                    @elseif($soal->jawaban_c == 4)
                                                        C
                                                    @elseif($soal->jawaban_d == 4)
                                                        D
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($soal->jawaban_a == 3)
                                                        A
                                                    @elseif($soal->jawaban_b == 3)
                                                        B
                                                    @elseif($soal->jawaban_c == 3)
                                                        C
                                                    @elseif($soal->jawaban_d == 3)
                                                        D
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($soal->jawaban_a == 2)
                                                        A
                                                    @elseif($soal->jawaban_b == 2)
                                                        B
                                                    @elseif($soal->jawaban_c == 2)
                                                        C
                                                    @elseif($soal->jawaban_d == 2)
                                                        D
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($soal->jawaban_a == 1)
                                                        A
                                                    @elseif($soal->jawaban_b == 1)
                                                        B
                                                    @elseif($soal->jawaban_c == 1)
                                                        C
                                                    @elseif($soal->jawaban_d == 1)
                                                        D
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @elseif($kategori[2] == $soal->kategori)
                                <div class="row">
                                    <div class="col-md-6  mx-auto">
                                        <table border="1px" class="table table-striped">
                                            <tr>
                                                <th style="width:10%">Level</th>
                                                <th style="width:45%">Deskripsi</th>
                                                <th style="width:45%">Indikator Pelaku</th>
                                            </tr>
                                            <tr>
                                                <td><?= $soal->level ?></td>
                                                <td><?= $soal->deskripsi ?></td>
                                                <td><?= $soal->indikator ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    @if ($soal->pembahasan != null)
                                        <p>
                                            <b style="color:red">Pembahasan :</b> <?= $soal->pembahasan ?>
                                        </p>
                                    @endif 
                                    @if($soal->pembahasan_gambar != null)
                                        <img src="{{ asset('/') }}upload/soal/img/{{ $soal->pembahasan_gambar }}"
                                            style="width:50%" alt="">
                                    @endif
                                    <p>
                                        Bobot nilai jawaban berjenjang dari 1 hingga 5 poin dan 0 poin jika tidak menjawab.
                                        Urutan berdasarkan skala kematangan dari yang tertinggi (5) ke yang terendah (1)
                                        dapat dilihat pada tabel berikut:
                                    </p>
                                    <div class="col-md-6  mx-auto">
                                        <table border="1px" class="table table-striped text-center">
                                            <tr>
                                                <th style="width:20%">Nilai 5</th>
                                                <th style="width:20%">Nilai 4</th>
                                                <th style="width:20%">Nilai 3</th>
                                                <th style="width:20%">Nilai 2</th>
                                                <th style="width:20%">Nilai 1</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @if ($soal->jawaban_a == 5)
                                                        A
                                                    @elseif($soal->jawaban_b == 5)
                                                        B
                                                    @elseif($soal->jawaban_c == 5)
                                                        C
                                                    @elseif($soal->jawaban_d == 5)
                                                        D
                                                    @elseif($soal->jawaban_e == 5)
                                                        E
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($soal->jawaban_a == 4)
                                                        A
                                                    @elseif($soal->jawaban_b == 4)
                                                        B
                                                    @elseif($soal->jawaban_c == 4)
                                                        C
                                                    @elseif($soal->jawaban_d == 4)
                                                        D
                                                    @elseif($soal->jawaban_e == 4)
                                                        E
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($soal->jawaban_a == 3)
                                                        A
                                                    @elseif($soal->jawaban_b == 3)
                                                        B
                                                    @elseif($soal->jawaban_c == 3)
                                                        C
                                                    @elseif($soal->jawaban_d == 3)
                                                        D
                                                    @elseif($soal->jawaban_e == 3)
                                                        E
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($soal->jawaban_a == 2)
                                                        A
                                                    @elseif($soal->jawaban_b == 2)
                                                        B
                                                    @elseif($soal->jawaban_c == 2)
                                                        C
                                                    @elseif($soal->jawaban_d == 2)
                                                        D
                                                    @elseif($soal->jawaban_e == 2)
                                                        E
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($soal->jawaban_a == 1)
                                                        A
                                                    @elseif($soal->jawaban_b == 1)
                                                        B
                                                    @elseif($soal->jawaban_c == 1)
                                                        C
                                                    @elseif($soal->jawaban_d == 1)
                                                        D
                                                    @elseif($soal->jawaban_e == 1)
                                                        E
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @elseif($kategori[3] == $soal->kategori)
                                <div class="row">
                                    <p>
                                        @if ($soal->jawaban_terbaik != null)
                                            <b style="color:red">Jawaban Terbaik :</b> <?= $soal->jawaban_terbaik ?>
                                        @endif
                                        <br>
                                        @if ($soal->pembahasan != '')
                                            <b style="color:red">Pembahasan :</b> <?= $soal->pembahasan ?>
                                        @endif
                                        @if($soal->pembahasan_gambar != null)
                                            <img src="{{ asset('/') }}upload/soal/img/{{ $soal->pembahasan_gambar }}"
                                                style="width:50%" alt="">
                                        @endif
                                    </p>
                                    <p>
                                        Bobot nilai jawaban berjenjang dari 1 hingga 4 poin dan 0 poin jika tidak menjawab.
                                        Urutan berdasarkan skala kematangan dari yang tertinggi (4) ke yang terendah (1)
                                        dapat dilihat pada tabel berikut:
                                    </p>
                                    <div class="col-md-6  mx-auto">
                                        <table border="1px" class="table table-striped text-center">
                                            <tr>
                                                <th style="width:25%">Nilai 4</th>
                                                <th style="width:25%">Nilai 3</th>
                                                <th style="width:25%">Nilai 2</th>
                                                <th style="width:25%">Nilai 1</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @if ($soal->jawaban_a == 4)
                                                        A
                                                    @elseif($soal->jawaban_b == 4)
                                                        B
                                                    @elseif($soal->jawaban_c == 4)
                                                        C
                                                    @elseif($soal->jawaban_d == 4)
                                                        D
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($soal->jawaban_a == 3)
                                                        A
                                                    @elseif($soal->jawaban_b == 3)
                                                        B
                                                    @elseif($soal->jawaban_c == 3)
                                                        C
                                                    @elseif($soal->jawaban_d == 3)
                                                        D
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($soal->jawaban_a == 2)
                                                        A
                                                    @elseif($soal->jawaban_b == 2)
                                                        B
                                                    @elseif($soal->jawaban_c == 2)
                                                        C
                                                    @elseif($soal->jawaban_d == 2)
                                                        D
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($soal->jawaban_a == 1)
                                                        A
                                                    @elseif($soal->jawaban_b == 1)
                                                        B
                                                    @elseif($soal->jawaban_c == 1)
                                                        C
                                                    @elseif($soal->jawaban_d == 1)
                                                        D
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- nomor soal --}}
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <b>NOMOR SOAL</b>
                        </center>
                        <hr>
                        Keterangan
                        <br>
                        <div class="form-inline">
                            <div style="height:30px; width:30px; background-color:green; border-radius:5px;"></div>&nbsp; =
                            Benar
                        </div>

                        <br>
                        <div class="form-inline">
                            <div style="height:30px; width:30px; background-color:red; border-radius:5px;"></div>&nbsp; =
                            Salah
                        </div>

                        <br>
                        <div class="form-inline">
                            <div style="height:30px; width:30px; background-color:grey; border-radius:5px;"></div>&nbsp; =
                            Kosong
                        </div>
                        <hr>
                        <div class="container">
                            <div class="row text-center" style="overflow: auto;height:500px">
                                @foreach ($soallist as $i => $a)
                                    @php
                                        $cekbutton[$i+1] = DB::table('jawabans')
                                            ->where('id_user', session('id_pengguna'))
                                            ->where('id_paket', $id_paket)
                                            ->where('id_ujian', $id_ujian)
                                            ->where('no_soal', $a->no_soal)
                                            ->first();
                                    @endphp
                                    @if (@count($cekbutton[$i+1]) > 0)
                                        @if ($cekbutton[$i+1]->ragu_ragu == '1')
                                            @if ($a->no_soal == $cekbutton[$i+1]->no_soal)
                                                <a style="color:white;width:50px; height:50px;margin:5px 5px; text-align:center;padding:11px 0; border-radius:5px"
                                                    class="w3-grey w3-border w3-border-grey"
                                                    href="{{ url('ujian/review-ujian/' . $id_ujian . '/' . $id_fasilitas . '/' . $id_paket . '/' . $a->no_soal) }}">
                                                    <b>{{ $a->no_soal }}</b>
                                                </a>
                                            @else
                                                <a style="color:white;width:50px; height:50px;margin:5px 5px; text-align:center;padding:11px 0; border-radius:5px"
                                                    class="w3-grey w3-border w3-border-grey"
                                                    href="{{ url('ujian/review-ujian/' . $id_ujian . '/' . $id_fasilitas . '/' . $id_paket . '/' . $a->no_soal) }}">
                                                    <b>{{ $a->no_soal }}</b>
                                                </a>
                                            @endif
                                        @else
                                        
                                            @if ($a->no_soal == $cekbutton[$i+1]->no_soal)
                                                @if ($kategori[0] == $a->kategori)
                                                    @if ($a->{'jawaban_' . $cekbutton[$i+1]->jawaban} == 5)
                                                        <a style="color:white;width:50px; height:50px;margin:5px 5px; text-align:center;padding:11px 0; border-radius:5px"
                                                            class="w3-green w3-border w3-border-green"
                                                            href="{{ url('ujian/review-ujian/' . $id_ujian . '/' . $id_fasilitas . '/' . $id_paket . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b>
                                                        </a>
                                                    @else
                                                        <a style="color:white;width:50px; height:50px;margin:5px 5px; text-align:center;padding:11px 0; border-radius:5px"
                                                            class="w3-red w3-border w3-border-red"
                                                            href="{{ url('ujian/review-ujian/' . $id_ujian . '/' . $id_fasilitas . '/' . $id_paket . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b>
                                                        </a>
                                                    @endif
                                                @elseif($kategori[1] == $a->kategori)
                                                    @if ($a->{'jawaban_' . $cekbutton[$i+1]->jawaban} == 4)
                                                        <a style="color:white;width:50px; height:50px;margin:5px 5px; text-align:center;padding:11px 0; border-radius:5px"
                                                            class="w3-green w3-border w3-border-green"
                                                            href="{{ url('ujian/review-ujian/' . $id_ujian . '/' . $id_fasilitas . '/' . $id_paket . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b>
                                                        </a>
                                                    @else
                                                        <a style="color:white;width:50px; height:50px;margin:5px 5px; text-align:center;padding:11px 0; border-radius:5px"
                                                            class="w3-red w3-border w3-border-red"
                                                            href="{{ url('ujian/review-ujian/' . $id_ujian . '/' . $id_fasilitas . '/' . $id_paket . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b>
                                                        </a>
                                                    @endif
                                                @elseif($kategori[2] == $a->kategori)
                                                    @if ($a->{'jawaban_' . $cekbutton[$i+1]->jawaban} == 5)
                                                        <a style="color:white;width:50px; height:50px;margin:5px 5px; text-align:center;padding:11px 0; border-radius:5px"
                                                            class="w3-green w3-border w3-border-green"
                                                            href="{{ url('ujian/review-ujian/' . $id_ujian . '/' . $id_fasilitas . '/' . $id_paket . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b>
                                                        </a>
                                                    @else
                                                        <a style="color:white;width:50px; height:50px;margin:5px 5px; text-align:center;padding:11px 0; border-radius:5px"
                                                            class="w3-red w3-border w3-border-red"
                                                            href="{{ url('ujian/review-ujian/' . $id_ujian . '/' . $id_fasilitas . '/' . $id_paket . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b>
                                                        </a>
                                                    @endif
                                                @elseif($kategori[3] == $a->kategori)
                                                    @if ($a->{'jawaban_' . $cekbutton[$i+1]->jawaban} == 4)
                                                        <a style="color:white;width:50px; height:50px;margin:5px 5px; text-align:center;padding:11px 0; border-radius:5px"
                                                            class="w3-green w3-border w3-border-green"
                                                            href="{{ url('ujian/review-ujian/' . $id_ujian . '/' . $id_fasilitas . '/' . $id_paket . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b>
                                                        </a>
                                                    @else
                                                        <a style="color:white;width:50px; height:50px;margin:5px 5px; text-align:center;padding:11px 0; border-radius:5px"
                                                            class="w3-red w3-border w3-border-red"
                                                            href="{{ url('ujian/review-ujian/' . $id_ujian . '/' . $id_fasilitas . '/' . $id_paket . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b>
                                                        </a>
                                                    @endif
                                                @endif
                                            @else
                                                <a style="color:white;width:50px; height:50px;margin:5px 5px; text-align:center;padding:11px 0; border-radius:5px"
                                                    class="w3-grey w3-border w3-border-grey"
                                                    href="{{ url('ujian/review-ujian/' . $id_ujian . '/' . $id_fasilitas . '/' . $id_paket . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b>
                                                </a>
                                            @endif
                                        @endif
                                    @else
                                        <a style="color:white;width:50px; height:50px;margin:5px 5px; text-align:center;padding:11px 0; border-radius:5px"
                                            class="w3-grey w3-border w3-border-grey "
                                            href="{{ url('ujian/review-ujian/' . $id_ujian . '/' . $id_fasilitas . '/' . $id_paket . '/' . $a->no_soal) }}"><b>{{ $a->no_soal }}</b>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <script>
        $('#reviews').hide()

        function reportsoal(id_soal, id_paket, id_fasilitas) {
            $('#id_soalx').val(id_soal);
            $('#id_paketx').val(id_paket);
            $('#id_fasilitasx').val(id_fasilitas);
            $('#reportSoal').modal('show')
        }
    </script>

@endsection
