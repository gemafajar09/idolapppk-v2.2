<x-template title="Iklan">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Data Iklan</h5>
                            <a href="{{ route('iklan.create') }}" class="btn btn-outline-success btn-sm mb-2">Tambah
                                Iklan</a>
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Foto Iklan</th>
                                        <th scope="col">Link</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($iklans as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            
                                            <td><img src='{{asset("foto/$item->foto")}}' alt="" style="width: 100px;"></td>
                                            <td>{{ $item->link }}</td>
                                            <td>{{ $item->deskripsi }}</td>

                                            <td>
                                                <div class="d-grid gap-2 col-6">
                                                    @php
                                                        $id_iklan = App\Helper\HashHelper::encryptData($item->id);
                                                    @endphp
                                                    <a href="{{ route('iklan.edit', $id_iklan) }}"
                                                        class="btn btn-outline-primary btn-sm btn-block">Edit</a>
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm btn-block"
                                                        onclick="tampil('{{ route('iklan.destroy', $id_iklan) }}')">Delete</button>
                                                </div>
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
