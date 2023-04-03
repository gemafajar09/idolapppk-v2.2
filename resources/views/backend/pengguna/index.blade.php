<x-template title="Member">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Data Member</h5>

                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Kode Afiliasi</th>
                                        <th scope="col">No Telpon</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Komisi</th>
                                        <th scope="col">Awards</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengguna as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>
                                                {{ $item->nama }}
                                            </td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                {{ $item->kode_afiliasi }}
                                            </td>
                                            <td>
                                                {{ $item->no_telpon }}
                                            </td>
                                            <td>
                                                {{ $item->kota->nama_kota ?? "" }},{{ $item->provinsi->nama_provinsi ?? "" }}
                                            </td>
                                            <td>
                                                Rp. {{ number_format($item->saldo_afiliasi) }}
                                            </td>
                                            <td>
                                                {{ $item->afiliasi_awards }}
                                            </td>
                                            <td>
                                                {{ $item->password_confirmation }}
                                            </td>
                                            <td>
                                                <span class="badge bg-success text-white text-wrap"
                                                    style="width: 7rem;">{{ $item->status_user }}</span>
                                            </td>
                                            <td>
                                                @php
                                                    $id_user = App\Helper\HashHelper::encryptData($item->id);
                                                @endphp
                                                <button type="button" class="btn btn-outline-primary btn-sm"
                                                    onclick="tampil('{{ route('pengguna.update', $id_user) }}','{{ $item->status_user }}')">Status</button>
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

    <div class="modal fade" id="updateStatusUser" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Status User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="formUpdateStatusUser">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Status User</label>
                            <select name="status_user" id="status_user" class="form-control" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
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
        function tampil(url, status) {
            $('#formUpdateStatusUser').attr('action', url);
            $('#status_user').val(status)
            $('#updateStatusUser').modal('show')
        }
    </script>


</x-template>
