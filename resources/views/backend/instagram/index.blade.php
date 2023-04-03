<x-template title="instagram">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Data instagram</h5>
                            <a href="{{ route('instagram.create') }}" class="btn btn-outline-success btn-sm mb-2">Tambah
                                instagram</a>
                            <div class="row">
                                @foreach ($iklans as $no => $iklan)
                                @php
                                    $id_iklan = App\Helper\HashHelper::encryptData($iklan->id);
                                @endphp
                                <div class="col-md-6 col-xl-4">
                                    <div style="position: relative;">
                                        {!! $iklan->embed !!}
                                        <div style="position: absolute; top: 0; left: 0; padding: 12px; padding-right: 40%; background-color:white;">
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-block" onclick="tampil('{{ route('instagram.destroy', $id_iklan) }}')">Delete</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
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
