<x-template title="Testimoni">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Data Testimoni</h5>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Umur</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Formasi</th>
                                        <th scope="col">Testimoni</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimoni as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->umur }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->formasi }}</td>
                                            <td>{{ $item->testimoni }}</td>
                                            @php
                                                $id_testimoni = App\Helper\HashHelper::encryptData($item->id);
                                            @endphp
                                            <td>
                                                <button type="button" class="btn btn-outline-danger btn-sm btn-block"
                                                    onclick="tampil('{{ route('testimoni.admin.delete', $id_testimoni) }}')">Delete</button>
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
                        @method('delete')
                        <h5>Yakin Untuk Menghapus Data ?</h5>
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
        function tampil(url) {
            $('#formUpdateStatusUser').attr('action', url);
            $('#updateStatusUser').modal('show')
        }
    </script>


</x-template>
