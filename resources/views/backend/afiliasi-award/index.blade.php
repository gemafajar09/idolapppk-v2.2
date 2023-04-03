<x-template title="Afiliasi Award">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Data Afiliasi Awards</h5>

                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Pengguna</th>
                                        <th scope="col">Bank</small></th>
                                        <th scope="col">No Rekening</th>
                                        <th scope="col">Saldo Pencairan Award</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($award as $key => $item)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>
                                            <span>{{ $item->secret_code_award }}</span>

                                        </td>
                                        <td>{{ $item->pengguna->nama ?? '' }}</td>
                                        <td>
                                            <span>{{ strtoupper($item->informasi_bank) }}</span>
                                        </td>
                                        <td>
                                            {{$item->no_rekening}}
                                        </td>
                                        <td>
                                            Rp. {{number_format($item->saldo_komisi_award)}}
                                        </td>
                                        <td>
                                            <span>{{ date('d/m/Y', strtotime($item->tanggal_award)) }}</span>
                                        </td>
                                        <td><span class="badge bg-success text-white text-wrap"
                                                style="width: 7rem;">{{ $item->status_award }}</span></td>
                                        @php
                                        $data = [
                                        'id' => $item->id,
                                        'kode' => $item->secret_code_award,
                                        ];
                                        $id_award = App\Helper\HashHelper::encryptArray($data);
                                        @endphp
                                        <td>
                                            @if ($item->status_award == 'Menunggu Verifikasi')
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                onclick="tampil('{{ route('pencairan-award.update', $id_award) }}','{{ $item->secret_code_award }}')">Verifikasi</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Proses Pencairan Award</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Kode : <span id="secret_code_award"></span></p>
                    <form method="POST" id="formUpdateAward">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Status Pencairan</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="Valid">Pencairan Valid</option>
                                <option value="Tidak Valid">Pencairan Tidak Valid</option>
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
    function tampil(url, secret_code_award) {
        $('#formUpdateAward').attr('action', url);
        $('#secret_code_award').html(secret_code_award)
        $('#updateStatus').modal('show')
    }
    </script>
</x-template>