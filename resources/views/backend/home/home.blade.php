<x-template title="Dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Paket -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card" style="background: #856043;border-radius:20px;box-shadow: 0px 0px 5px 1px rgba(133, 130, 130, 0.877);">

                        <div class="card-body">
                            <h5 class="card-title text-white" >Jumlah Paket</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-book"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 class="text-white">{{ $jumPaket }}</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Try Out -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card" style="background: #856043;border-radius:20px;box-shadow: 0px 0px 5px 1px rgba(133, 130, 130, 0.877);">

                        <div class="card-body">
                            <h5 class="card-title text-white">Jumlah Paket Ujian</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-book"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 class="text-white">3</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- MEmber -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card" style="background: #856043;border-radius:20px;box-shadow: 0px 0px 5px 1px rgba(133, 130, 130, 0.877);">

                        <div class="card-body">
                            <h5 class="card-title text-white">Jumlah Member</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 class="text-white">{{ $jumPengguna }}</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Order Kelas -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="{{route('home','today')}}">Today</a></li>
                                <li><a class="dropdown-item" href="{{route('home','ThisMonth')}}">This Month</a></li>
                                <li><a class="dropdown-item" href="{{route('home','ThisYear')}}">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Order Kelas <span>| {{$type}}</span></h5>

                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Pengguna</th>
                                        <th scope="col">Referal <small>(*diskon)</small></th>
                                        <th scope="col">Total Bayar</th>
                                        <th scope="col">Komisi</th>
                                        <th scope="col">Bersih</th>
                                        <th scope="col">Detail</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $key => $item)
                                        <tr>
                                            <td>
                                                <span>{{ $item->kode_pembelian }}</span>
                                                <br>
                                                <span>{{ date('d/m/Y', strtotime($item->tanggal_pembelian)) }}</span>
                                            </td>
                                            <td>{{ $item->pengguna->nama ?? '' }}</td>
                                            <td>
                                                <span>Rp. {{ number_format($item->potong_harga) ?? 0 }}</span>
                                                <br>
                                                <span>{{ $item->kode_referal }}</span>
                                            </td>

                                            <td>
                                                <span>Rp. {{ number_format($item->total_bayar) }}</span>
                                                <br>
                                                <span>{{ strtoupper($item->bank) }}</span>
                                            </td>
                                            @php
                                                $persenAfiliasi = DB::table('persen_afiliasis')->first()->persen ?? 25;
                                            @endphp
                                            <td>
                                                @if (!empty($item->kode_referal))
                                                    <span>Rp.
                                                        {{ number_format($item->total_bayar * ($persenAfiliasi / 100)) }}</span>
                                                @else
                                                <span>Rp.
                                                    {{ number_format(0) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($item->kode_referal))
                                                    <span>Rp.
                                                        {{ number_format($item->total_bayar - $item->total_bayar * ($persenAfiliasi / 100)) }}</span>
                                                @else
                                                    <span>Rp.
                                                        {{ number_format($item->total_bayar) }}</span>
                                                @endif
                                            </td>
                                            <td>

                                                @foreach ($item->detail as $detail)
                                                    <span>- {{ $detail->paket->nama_paket ?? '' }}</span>
                                                    <br>
                                                @endforeach

                                            </td>
                                            <td><span class="badge bg-success text-white text-wrap"
                                                    style="width: 7rem;">{{ $item->status_pembelian }}</span></td>
                                            @php
                                                $data = [
                                                    'id_transaksi' => $item->id,
                                                    'kode_pembelian' => $item->kode_pembelian,
                                                ];
                                                $id_transaksi = App\Helper\HashHelper::encryptArray($data);
                                            @endphp
                                            <td>
                                                @if ($item->status_pembelian == 'Menunggu Pembayaran')
                                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                                        onclick="tampil('{{ route('transaksi.update', $id_transaksi) }}','{{ $item->kode_pembelian }}')">Verifikasi</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="card top-selling overflow-auto">

                        <div class="card-body pb-0">
                            <h5 class="card-title">Riwayat Pendapatan Bulan Ini</h5>

                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Total Pembayaran</th>
                                        <th scope="col">Total Komisi</th>
                                        <th scope="col">Total Bersih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_bayar  = 0;
                                        $total_komisi = 0;  
                                    @endphp
                                    @foreach ($total_pendapatan as $i => $item)
                                    @php
                                        $total_bayar += $item->total_bayar;   
                                        $total_komisi += $item->total_komisi;   
                                    @endphp
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td>{{date('d/m/Y',strtotime($item->tanggal_pembelian))}}</td>
                                            <td>Rp. {{ number_format($item->total_bayar)}}</td>
                                            <td>Rp. {{ number_format($item->total_komisi)}}</td>
                                            <td>Rp. {{ number_format($item->total_bayar - $item->total_komisi)}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-success text-white">
                                    <tr>
                                        <td colspan="2" class="text-center">Total</td>
                                        <td>Rp. {{ number_format($total_bayar)}}</td>
                                        <td>Rp. {{ number_format($total_komisi)}}</td>
                                        <td>Rp. {{ number_format($total_bayar - $total_komisi)}}</td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>

                    </div>
                </div>

                <!-- Reports -->
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Total Pendapatan Bersih Bulan Ini</h5>

                            <!-- Line Chart -->
                            <div id="reportsChart"></div>


                        </div>

                    </div>
                </div>


            </div>
        </div><!-- End Left side columns -->

    </div>

    {{-- tambah --}}
    <div class="modal fade" id="updateStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Status Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Kode : <span id="kode_pembelian"></span></p>
                    <form method="POST" id="formUpdateTransaksi">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Status Pembelian</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="Berhasil">Pembayaran Berhasil</option>
                                <option value="Tidak Valid">Pembayaran Tidak Valid</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Proses</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function tampil(url, kode_pembelian) {
            $('#formUpdateTransaksi').attr('action', url);
            $('#kode_pembelian').html(kode_pembelian)
            $('#updateStatus').modal('show')
        }
        
    </script>
    <script>
        $(document).ready(function() {
            $.ajax({
                    method: "GET",
                    url: "{{ route('api.total.pendapatan') }}",
                })
                .done(function(response) {
                    dataY = []
                    dataX = []
                    response.forEach(element => {
                        var total_bersih = parseInt(element.total_bayar) - parseInt(element.total_komisi)
                        dataY.push(total_bersih)
                        dataX.push(element.tanggal_pembelian)
                    });
                    new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                            name: 'Total Bersih',
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
                                format: 'dd/MM/yy'
                            },
                        }
                    }).render();
                });
        })
    </script>
</x-template>
