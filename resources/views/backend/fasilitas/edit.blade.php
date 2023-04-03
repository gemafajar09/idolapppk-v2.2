<x-template title="Fasilitas">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Form Tambah Fasilitas</h5>
                            <div class="card-body">
                                @php
                                    $id_fasilitas = App\Helper\HashHelper::encryptData($fasilitas->id);
                                @endphp
                                <form action="{{ route('fasilitas.update', $id_fasilitas) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Paket*</label>
                                        <select name="id_paket" id="id_paket" class="form-control" required>
                                            <option value="">Pilih Paket</option>
                                            @foreach ($paket as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_paket }}</option>
                                            @endforeach
                                        </select>
                                        <script>
                                            document.getElementById('id_paket').value = '{{ $fasilitas->id_paket }}'
                                        </script>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Tipe Fasilitas*</label>
                                        <select name="tipe_fasilitas" id="tipe_fasilitas" class="form-control"
                                            required>
                                            <option value="">Pilih Tipe</option>
                                            <option value="Materi Video">Materi Video</option>
                                            <option value="Materi PDF">Materi PDF</option>
                                            <option value="Ujian">Ujian</option>
                                            <option value="Informasi">Informasi</option>
                                        </select>
                                        <script>
                                            document.getElementById('tipe_fasilitas').value = '{{ $fasilitas->tipe_fasilitas }}'
                                        </script>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Nama Fasilitas*</label>
                                        <input type="text" name="nama_fasilitas" id="nama_fasilitas"
                                            class="form-control"
                                            value="{{ $fasilitas->nama_fasilitas ?? old('nama_fasilitas') }}" required>
                                    </div>
                                    <div class="form-group mb-2" style="display: none;">
                                        <label for="" class="mb-2">Link Fasilitas <small>(*Hanya Untuk
                                                Ujian)</small></label>
                                        <input type="text" name="link_fasilitas" id="link_fasilitas"
                                            class="form-control"
                                            value="{{ $fasilitas->link_fasilitas ?? old('link_fasilitas') }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Status*</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="Aktif">Aktif</option>
                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                        </select>
                                        <script>
                                            document.getElementById('status').value = '{{ $fasilitas->status }}'
                                        </script>
                                    </div>
                                    <div class="form-group mb-2">
                                        <button class="btn btn-outline-success" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Left side columns -->

    </div>






</x-template>
