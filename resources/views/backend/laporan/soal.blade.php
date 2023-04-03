<x-template title="Laporan Soal">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Riwayat Pencairan</h5>

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Paket</th>
                                    <th scope="col">Nama Paket Ujian</th>
                                    <th scope="col">Soal</th>
                                    <th scope="col">Kategori Laporan</th>
                                    <th scope="col">Laporan</th>
                                    <th scope="col">Tgl Lapor</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($laporans as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $item->paket->nama_paket ?? '' }}</td>
                                        <td>{{ $item->fasilitas->nama_fasilitas ?? '' }}</td>
                                        <td>{{ $item->soal->soal ?? '' }}</td>
                                        <td>{{ $item->kategori_laporan }}</td>
                                        <td>{{ $item->laporan }}</td>
                                        <td>{{ date('d/m/Y', strtotime($item->tgl_lapor)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                           
                        </table>

                    </div>
                </div>

            </div>
        </div><!-- End Left side columns -->

    </div>



</x-template>
