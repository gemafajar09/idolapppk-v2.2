@extends('user.layout.app')
@section('title', 'IdolaPPPK - Hasil Try Out')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>
    $(document).ready( function () {
        $('.myTable').DataTable();
    } );
</script>
    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    @if (count($hasilujians) >= 0)
                        <div class="card">
                            <div class="card-header">
                                <h5>Hasil Try Out</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table myTable">
                                        <thead style="font-size:12px; background-color:#856043; color:white;">
                                            <th>No</th>
                                            <th>Paket Try Out</th>
                                            <th>Tanggal Ujian</th>
                                            <th>Teknis</th>
                                            <th>Manajerial </th>
                                            <th>Sosio</th>
                                            <th>Wawancara</th>
                                            <th>Total Skor</th>
                                            <th style="width:12%">Lulus</th>
                                            <th>Opsi</th>
                                        </thead>
                                        <tbody style="font-size:12px">
                                            @foreach ($hasilujians as $key => $item)
                                                @php
                                                    $totalSoal = DB::table('soals')
                                                        ->where('id_paket', $item->id_paket)
                                                        ->where('id_fasilitas', $item->id_fasilitas)
                                                        ->count();

                                                    $totalNilai = $item->bobot_a + $item->bobot_b + $item->bobot_c + $item->bobot_d;

                                                    $cekStandar = DB::table('skorsoals')
                                                        ->where('id_paket', $item->id_paket)
                                                        ->where('id_fasilitas', $item->id_fasilitas)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->nama_fasilitas }}</td>
                                                    <td>{{ App\Helper\HashHelper::tglIndo($item->tgl_ujian) }}</td>
                                                    <td>{{ $item->bobot_a }}</td>
                                                    <td>{{ $item->bobot_b }}</td>
                                                    <td>{{ $item->bobot_c }}</td>
                                                    <td>{{ $item->bobot_d }}</td>
                                                    <td>{{ $totalNilai }}</td>
                                                    <td>
                                                   
                                                        @if ($item->bobot_b >= $cekStandar->manajer && $item->bobot_c >= $cekStandar->sosio && $item->bobot_d >= $cekStandar->wawancara)
                                                            <button style="font-size:12px" type="button"
                                                                class="btn btn-success btn-sm text-black">Lulus</button>
                                                        @else
                                                            <button style="font-size:12px" type="button"
                                                                class="btn btn-danger btn-sm text-black">Tidak
                                                                Lulus</button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a style="font-size:12px; background: #856043; color:white"
                                                            href="{{ route('review-ujian', [$item->id_ujian, $item->id_fasilitas, $item->id_paket]) }}"
                                                            target="blank" class="btn btn-sm text-white"
                                                            role="button">Review</a>
                                                        <a style="font-size:12px; background: #856043; color:white"
                                                            href="{{ route('hasil-ujian', [$item->id_ujian, $item->id_fasilitas, $item->id_paket]) }}"
                                                            target="blank" class="btn btn-sm"
                                                            role="button">Grafik</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-12 text-center">
                            <h2>Belum Pernah Mengerjakan Try Out</h2>
                            <img src="{{ asset('frontend/baru/images/no-paket.svg') }}" alt="" class="mb-3"
                                style="max-width:23em;">

                        </div>
                    @endif
                </div>
            </div>


            @foreach ($paket as $i => $isi)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header">
                                <h5>Ranking Tryout Nasional PPPK {{ $isi->nama_paket }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table myTable" style="font-size:12px">
                                        <thead>
                                            <th>Ranking</th>
                                            <th>Nama</th>
                                            @if($isi->id != 14)
                                            <th>Kompetensi Teknis</th>
                                            @endif
                                            <th>Kompetensi Manajerial</th>
                                            <th>Kompetensi Sosio Kultural </th>
                                            <th>Wawancara</th>
                                            <th>Total Skor</th>
                                        </thead>
                                        <tbody>
                                            @php($x[$i] = 1)
                                            @foreach ($ranking[$i] as $rank)
                                                <tr>
                                                    @if ($x[$i] == 1)
                                                        <td style="background-color:rgba(255, 231, 13, 0.452);">
                                                            <img src="{{ asset('medal/1.png') }}" alt="" class="h-5">
                                                        </td>
                                                        <td style="background-color:rgba(255, 231, 13, 0.452);">
                                                            {{ $rank->nama }}</td>
                                                        @if($isi->id != 14)
                                                        <td style="background-color:rgba(255, 231, 13, 0.452);">
                                                            {{ $rank->bobot_a }}</td>
                                                        @endif
                                                        <td style="background-color:rgba(255, 231, 13, 0.452);">
                                                            {{ $rank->bobot_b }}</td>
                                                        <td style="background-color:rgba(255, 231, 13, 0.452);">
                                                            {{ $rank->bobot_c }}</td>
                                                        <td style="background-color:rgba(255, 231, 13, 0.452);">
                                                            {{ $rank->bobot_d }}</td>
                                                        <td style="background-color:rgba(255, 231, 13, 0.452);">
                                                            {{ $rank->skor }}</td>
                                                    @elseif($x[$i] == 2)
                                                        <td style="background-color:rgba(158, 158, 158, 0.452);">
                                                            <img src="{{ asset('medal/2.png') }}" class="h-5" alt="">
                                                        </td>
                                                        <td style="background-color:rgba(158, 158, 158, 0.452);">
                                                            {{ $rank->nama }}</td>
                                                        @if($isi->id != 14)
                                                        <td style="background-color:rgba(158, 158, 158, 0.452);">
                                                            {{ $rank->bobot_a }}</td>
                                                        @endif
                                                        <td style="background-color:rgba(158, 158, 158, 0.452);">
                                                            {{ $rank->bobot_b }}</td>
                                                        <td style="background-color:rgba(158, 158, 158, 0.452);">
                                                            {{ $rank->bobot_c }}</td>
                                                        <td style="background-color:rgba(158, 158, 158, 0.452);">
                                                            {{ $rank->bobot_d }}</td>
                                                        <td style="background-color:rgba(158, 158, 158, 0.452);">
                                                            {{ $rank->skor }}</td>
                                                    @elseif($x[$i] == 3)
                                                        <td style="background-color:rgba(211, 146, 49, 0.452);">
                                                            <img src="{{ asset('medal/3.png') }}" class="h-5" alt="">
                                                        </td>
                                                        <td style="background-color:rgba(211, 146, 49, 0.452);">
                                                            {{ $rank->nama }}</td>
                                                        @if($isi->id != 14)
                                                        <td style="background-color:rgba(211, 146, 49, 0.452);">
                                                            {{ $rank->bobot_a }}</td>
                                                        @endif
                                                        <td style="background-color:rgba(211, 146, 49, 0.452);">
                                                            {{ $rank->bobot_b }}</td>
                                                        <td style="background-color:rgba(211, 146, 49, 0.452);">
                                                            {{ $rank->bobot_c }}</td>
                                                        <td style="background-color:rgba(211, 146, 49, 0.452);">
                                                            {{ $rank->bobot_d }}</td>
                                                        <td style="background-color:rgba(211, 146, 49, 0.452);">
                                                            {{ $rank->skor }}</td>
                                                    @else
                                                        <td>
                                                            {{ $x[$i] }}
                                                        </td>
                                                        <td>{{ $rank->nama }}</td>
                                                        @if($isi->id != 14)
                                                        <td>{{ $rank->bobot_a }}</td>
                                                        @endif
                                                        <td>{{ $rank->bobot_b }}</td>
                                                        <td>{{ $rank->bobot_c }}</td>
                                                        <td>{{ $rank->bobot_d }}</td>
                                                        <td>{{ $rank->bobot_a + $rank->bobot_b + $rank->bobot_c + $rank->bobot_d }}</td>
                                                    @endif
                                                </tr>
                                                @php($x[$i]++)
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
