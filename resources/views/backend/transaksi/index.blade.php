<x-template title="Order">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Data Order</h5>

                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Pengguna</th>
                                        <th scope="col">Tanggal Oder</th>
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
                                                <!--<span>{{ date('d/m/Y', strtotime($item->tanggal_pembelian)) }}</span>-->
                                            </td>
                                            <td>{{ $item->nama ?? '' }}</td>
                                            <td>{{ date('d/m/Y', strtotime($item->tanggal_pembelian)) }}</td>
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
                                            <td>{{ $item->nama_paket ?? '' }}</td>
                                            <td><span
                                                    class="badge <?= $item->status_pembelian == 'Tidak Valid' ? 'bg-danger' : 'bg-success' ?> text-white text-wrap"
                                                    style="width: 7rem;">{{ $item->status_pembelian }}</span></td>
                                            @php
                                                $data = [
                                                    'id_transaksi' => $item->id_pem,
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
</x-template>
