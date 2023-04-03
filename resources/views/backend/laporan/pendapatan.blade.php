<x-template title="Laporan Pendapatan">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card top-selling overflow-auto">
                        <div class="card-header">
                            <form action="{{route('laporan.pendapatan')}}" method="get">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Dari Tanggal</label>
                                        <input type="date" class="form-control" placeholder="First name"
                                            aria-label="First name" name="dari" value="{{$_GET['dari'] ?? ''}}">
                                    </div>
                                    <div class="col">
                                        <label for="">Sampai Tanggal</label>
                                        <input type="date" class="form-control" placeholder="Last name"
                                            aria-label="Last name" name="sampai" value="{{$_GET['sampai'] ?? ''}}">
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary mt-4">Lihat</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body pb-0">
                            <h5 class="card-title">Riwayat Pendapatan</h5>

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
                                        $total_bayar = 0;
                                        $total_komisi = 0;
                                    @endphp
                                    @foreach ($total_pendapatan as $i => $item)
                                        @php
                                            $total_bayar += $item->total_bayar;
                                            $total_komisi += $item->total_komisi;
                                        @endphp
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ date('d/m/Y', strtotime($item->tanggal_pembelian)) }}</td>
                                            <td>Rp. {{ number_format($item->total_bayar) }}</td>
                                            <td>Rp. {{ number_format($item->total_komisi) }}</td>
                                            <td>Rp. {{ number_format($item->total_bayar - $item->total_komisi) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-success text-white">
                                    <tr>
                                        <td colspan="2"></td>
                                        <td>Rp. {{ number_format($total_bayar) }}</td>
                                        <td>Rp. {{ number_format($total_komisi) }}</td>
                                        <td>Rp. {{ number_format($total_bayar - $total_komisi) }}</td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div><!-- End Left side columns -->

    </div>




</x-template>
