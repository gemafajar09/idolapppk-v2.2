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
                                <form action="{{route('fasilitas.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Paket*</label>
                                        <select name="id_paket" id="id_paket" class="form-control" required>
                                            <option value="">Pilih Paket</option>
                                            @foreach ($paket as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_paket }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Tipe Fasilitas*</label>
                                        <select name="tipe_fasilitas" id="tipe_fasilitas" class="form-control" required>
                                            <option value="">Pilih Tipe</option>
                                            <option value="Materi Video">Materi Video</option>
                                            <option value="Materi PDF">Materi PDF</option>
                                            <option value="Ujian">Ujian</option>
                                            <option value="Informasi">Informasi</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Nama Fasilitas*</label>
                                        <input type="text" name="nama_fasilitas" id="nama_fasilitas" class="form-control" value="{{old('nama_fasilitas')}}" required>
                                    </div>
                                    <div class="form-group mb-2" style="display: none;">
                                        <label for="" class="mb-2">Link Fasilitas <small>(*Hanya Untuk Ujian)</small></label>
                                        <input type="text" name="link_fasilitas" id="link_fasilitas" class="form-control" value="{{old('link_fasilitas')}}" >
                                    </div>
                                    <div class="form-group mb-2">
                                        <button class="btn btn-outline-success" type="submit">Tambah</button>
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
