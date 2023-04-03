<x-template title="Laporan Pencairan">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card top-selling overflow-auto">
                        <div class="card-header">
                            <form action="{{route('laporan.pencairan')}}" method="get">
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
                            <h5 class="card-title">Riwayat Pencairan</h5>

                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Total Komisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_komisi = 0;
                                    @endphp
                                    @foreach ($total_pencairan as $i => $item)
                                        @php
                                            $total_komisi += $item->saldo_komisi;
                                        @endphp
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ date('d/m/Y', strtotime($item->tanggal_pencairan)) }}</td>
                                            <td>{{ $item->pengguna->nama ?? "" }}</td>
                                            <td>Rp. {{ number_format($item->saldo_komisi) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-success text-white">
                                    <tr>
                                        <td colspan="3" class="text-center">Total</td>
                                        <td>Rp. {{ number_format($total_komisi) }}</td>
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
