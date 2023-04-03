<x-template title="Faq">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Data Faq</h5>
                            <a href="{{ route('faq.create') }}" class="btn btn-outline-success btn-sm mb-2">Tambah
                                Faq</a>
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Pertanyaan Faq</th>
                                        <th scope="col">Jawaban Faq</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faq as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>
                                                {{ $item->pertanyaan }}
                                            </td>
                                            <td>{{ $item->jawaban }}</td>

                                            <td>
                                                <div class="d-grid gap-2 col-6">
                                                    @php
                                                        $id_faq = App\Helper\HashHelper::encryptData($item->id);
                                                    @endphp
                                                    <a href="{{ route('faq.edit', $id_faq) }}"
                                                        class="btn btn-outline-primary btn-sm btn-block">Edit</a>
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm btn-block"
                                                        onclick="tampil('{{ route('faq.destroy', $id_faq) }}')">Delete</button>
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
