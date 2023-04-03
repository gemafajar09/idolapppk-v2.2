@extends('user.layout.app')
@section('title', 'IdolaPPPK - Pencairan Affiliasi')

@section('content')
<div class="pagetitle">
    <h1>Pencairan Affiliasi</h1>
    
</div>

    <!-- ======= Pricing Section ======= -->
    <section id="detail" class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="{{route('frontend.pencairan.afiliasi.proses')}}" method="POST">
                                        @csrf
                                        <h5>Form Pencairan</h5>
                                        <div class="row g-2">
                                            <div class="col-md mb-2">
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
                                            <div class="col-md mb-2">
                                                <div class="form-group">
                                                    <label for="">Informasi Bank</label>
                                                    <input type="text" name="informasi_bank" id="informasi_bank"
                                                        class="form-control" value="{{ $informasi->informasi_bank ?? old('informasi_bank') ?? '' }}"
                                                        placeholder="Nama Bank Ex. BNI">
                                                </div>
                                            </div>
                                            <div class="col-md mb-2">
                                                <div class="form-group">
                                                    <label for="">No Rekening</label>
                                                    <input type="text" name="no_rekening" id="no_rekening"
                                                        class="form-control" value="{{ $informasi->no_rekening ?? old('no_rekening') ?? '' }}"
                                                        placeholder="No Rekening Ex.312312">
                                                </div>
                                            </div>
                                            <div class="col-md mb-2">
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
                                    <br><br>
                                </div>
                                <div class="col-lg-4 col-md-12 col-12" data-aos="zoom-in" data-aos-delay="200">
                                    <div class="card p-4 text-center">
                                        <h5>Pencairan Komisi</h5>
                                        <div>
                                            <img src="{{ asset('frontend/baru/images/profile.svg') }}" alt="profile.png"
                                                style="width: 35%;">
                                        </div>
                                        <div class="mt-3">
                                            <h5>Saldo Afiliasi : Rp. {{ number_format($pengguna->saldo_afiliasi) }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-12 col-12" data-aos="zoom-in" data-aos-delay="200">
                                    <div class="boxprofile">
                                        @php
                                            $id_pengguna = App\Helper\HashHelper::encryptData(session('id_pengguna'));
                                        @endphp
                    
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h5>Histori Pencairan Komisi</h5>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Histori Pendapatan Komisi</h5>

                        <!-- Line Chart -->
                        <div id="reportsChart"></div>
                        <input type="hidden" name="id_pengguna" id="id_pengguna"
                            value="{{ session('id_pengguna') }}">
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
        </script>
    @endpush
@endsection

