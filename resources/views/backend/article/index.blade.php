<x-template title="Artikel">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Data Artikel</h5>
                            <a href="{{ route('artikel.create') }}" class="btn btn-outline-success btn-sm mb-2">Tambah
                                Artikel</a>
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Foto Artikel</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Tag</th>
                                        <th scope="col">Direkomendasikan?</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($artikels as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td><img src='{{ asset("foto/$item->foto") }}' alt=""
                                                    style="width: 100px;"></td>
                                            <td>
                                                {{ $item->judul }}
                                            </td>
                                            <td>
                                                @php
                                                    $tags = json_decode($item->tags, true) ?? [];
                                                    $tagss = [];
                                                    foreach ($tags as $tag) {
                                                        $index = $artikels_tags->filter(function ($value, $key) use ($tag) {
                                                            return $value->id == $tag;
                                                        });

                                                        if (count($index) > 0) {
                                                            $index = array_keys($index->toArray())[0];
                                                            $tagss[] = $artikels_tags[$index]['value'];
                                                        }
                                                    }
                                                @endphp
                                                @foreach ($tagss as $tag)
                                                    <span
                                                        class="badge bg-primary">{{ $tag }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $item->tipe ? 'YA' : '' }}</td>

                                            <td>
                                                <div class="d-grid gap-2 col-6">
                                                    @php
                                                        $id_artikel = App\Helper\HashHelper::encryptData($item->id);
                                                    @endphp
                                                    <a href="{{ route('artikel.edit', $id_artikel) }}"
                                                        class="btn btn-outline-primary btn-sm btn-block">Edit</a>
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm btn-block"
                                                        onclick="tampil('{{ route('artikel.destroy', $id_artikel) }}')">Delete</button>
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
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Banner Artikel</h5>
                            <form action="{{ route('artikelBanner') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                <div class="form-group mb-2">
                                    <input type="file" name="foto" id="foto" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <button class="btn btn-outline-success" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Left side columns -->

    </div>

    <div class="modal fade" id="updateStatusUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
