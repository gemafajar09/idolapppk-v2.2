@extends('user.layout.app')
@section('title', 'IdolaPPPK - Pencairan Affiliasi')

@section('content')
<div class="pagetitle container">
    <h1>Pencairan Affiliasi</h1>
</div>
@php
    $id = session('id');
    $saldo = DB::table('penggunas')->where('id',$id)->first();

@endphp
<!-- ======= Pricing Section ======= -->
<section id="detail" class="section dashboard container">
    <div class="row">
        <div class="col-lg-12">
            <div class="bg-white shadow-lg p-4">
                <div class="flex flex-col sm:flex-row gap-3 text-white">
                    <div class="bg-[#9e6925] flex-1 rounded-xl p-4">
                        <h1 class="text-xl">Saldo Komisi</h1>
                        <div class="flex items-center justify-between">
                            <i class='text-6xl bx bxs-wallet pt-2'></i>
                            <div class="text-right">
                                <!-- <div class="text-lg">
                                    0 point
                                </div> -->
                                <div class="text-3xl font-bold">
                                    Rp. {{number_format($saldo->saldo_afiliasi)}},- <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-[#9e6925] flex-1 rounded-xl p-4">
                        <h1 class="text-xl">Total Komisi Dicairkan</h1>
                        <div class="flex items-center justify-between">
                            <i class='text-6xl bx bx-money pt-2'></i>
                            <div class="text-right">
                                <!-- <div class="text-lg">
                                    0 point
                                </div> -->
                                <div class="text-3xl font-bold">
                                    Rp. {{ number_format($totalcair->total)}},- <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-md py-2">
                    <!-- Note:
                    <ul class="text-sm">
                        <li>
                            Minimal saldo untuk melakukan penarikan adalah Rp. 2.000.000,- (250 point)
                        </li>
                    </ul> -->
                </div>
                <div class="flex flex-col lg:flex-row gap-3">
                    <div class="w-full lg:w-1/2">
                        <!--<img class="w-full" src='{{ asset("frontend/REFERRAL.jpg")}}' />-->
                    </div>
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold">Kode Referal Saya</h2>
                        @php
                            $kode = session('kode_afiliasi');
                        @endphp
                        <input class="border p-2 outline-none rounded px-3 w-1/2 text-sm my-2" readonly value="{{ $kode }}" />
                        <div class="flex items-center gap-2">
                            <input class="border p-2 outline-none rounded px-3 w-2/3 text-sm" readonly value="https://test.idolapppk.com/register/{{ $kode }}" />
                            <button onclick='navigator.clipboard.writeText("https://test.idolapppk.com/register/{{ $kode }}");' class="text-sm bg-[#9e6925] py-1 px-3 flex items-center gap-2 rounded text-white hover:opacity-80">
                                <i class='bx bx-clipboard text-lg' ></i>
                                Copy
                            </button>
                        </div>
                        <sub class="block my-2">
                            Total jumlah klik pada link sebanyak 0 kali
                        </sub>
                        <div class="mt-4 max-w-xl text-sm text-gray-500">
                            <li>
                                Setiap pengguna yang melakukan pembelian menggunakan kode referral Anda akan mendapatkan extra diskon.
                            </li>
                            <li>
                                Anda berhak mendapatkan komisi untuk setiap pembelian paket yang menggunakan kode referral Anda.
                            </li>
                            <li>
                                Anda dapat mengubah kode referral supaya lebih mudah diingat dan dibagikan.
                            </li>
                            <li>
                                Anda juga dapat membagikan link di atas supaya lebih mudah digunakan.
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TODO: Ilangkan hidden untuk menampilkan view yang lama -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <h5 class="font-semibold text-center text-xl mb-3">Histori Pencairan Komisi</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Saldo Komisi</th>
                                            <th scope="col">Bank</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pencairan as $key=>$item)
                                            <tr>
                                                <td scope="row">{{$key+1}}</td>
                                                <td>{{$item->secret_kode}}</td>
                                                <td>Rp.{{number_format($item->saldo_komisi)}}</td>
                                                <td>
                                                    <small>{{$item->informasi_bank}}</small>-
                                                    <small>{{$item->no_rekening}}</small>
                                                    <br>
                                                    <small>{{$item->nama_penerima}}</small>
                                                </td>
                                                <td>{{$item->status_pencairan}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <form action="{{route('frontend.pencairan.afiliasi.proses')}}" method="POST">
                                @csrf
                                <h5 class="font-semibold text-center text-xl mb-3">Form Pencairan</h5>
                                <div class="row g-2">
                                    <div>
                                        <div class="form-group">
                                            <label for="">Saldo Komisi</label>
                                            <input type="text" name="saldo_komisi" id="saldo_komisi"
                                                class="form-control" value="{{ old('saldo_komisi') }}"
                                                placeholder="Nominal Saldo Ex. 10000">
                                        </div>
                                    </div>
                                    @php
                                        $informasi = DB::table('penggunas')->where('id',session('id_pengguna'))->first();
                                    @endphp
                                    <div>
                                        <div class="form-group">
                                            <label for="">Informasi Bank</label>
                                            <input type="text" name="informasi_bank" id="informasi_bank"
                                                class="form-control" value="{{ $informasi->informasi_bank ?? old('informasi_bank') ?? '' }}"
                                                placeholder="Nama Bank Ex. BNI">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label for="">No Rekening</label>
                                            <input type="text" name="no_rekening" id="no_rekening"
                                                class="form-control" value="{{ $informasi->no_rekening ?? old('no_rekening') ?? '' }}"
                                                placeholder="No Rekening Ex.312312">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label for="">Nama Penerima</label>
                                            <input type="text" name="nama_penerima" id="nama_penerima"
                                                class="form-control" value="{{ $informasi->nama ?? old('nama_penerima') ?? '' }}"
                                                placeholder="Nama Lengkap Penerima">
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-2 mt-1">
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">Proses</button>
                                        <button class="btn btn-danger" type="reset">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">Histori Pendapatan Komisi</h5>

                    <!-- Line Chart -->
                    <div id="reportsChart"></div>
                    <input type="hidden" name="id_pengguna" id="id_pengguna" value="{{ session('id_pengguna') }}">
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End Pricing Section -->
@push('addon-script')
<script>
$(document).ready(function() {
    var id_pengguna = $('#id_pengguna').val()
    $.ajax({
            method: "GET",
            url: "{{ route('api.histori.bonus') }}",
            data: {
                id_pengguna: id_pengguna
            }
        })
        .done(function(response) {
            dataY = []
            dataX = []
            response.forEach(element => {
                dataY.push(element.jumlah)
                dataX.push(element.tanggal_bonus)
            });
            new ApexCharts(document.querySelector("#reportsChart"), {
                series: [{
                    name: 'Sekarang',
                    data: dataY,
                }],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                },
                markers: {
                    size: 4
                },
                colors: ['#2eca6a'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    type: 'datetime',
                    categories: dataX
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                }
            }).render();
        });
})

function akumulasi(nilai) {

    var point_award = nilai.value;
    var award = point_award * 8000;
    document.getElementById('saldo_komisi_award').value = award;
}
</script>

@endpush
@endsection
