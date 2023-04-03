<x-template title="Kategori Paket">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Form Tambah</h5>
                            <div class="card-body">
                                <form action="{{route('kategori-materi.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Kode Kategori*</label>
                                        <input type="text" name="kode_kategori" id="kode" class="form-control" value="{{old('kode_kategori')}}" placeholder="Ex : TWK" >
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Nama Kategori*</label>
                                        <input type="text" name="nama_kategori" id="nama" class="form-control" value="{{old('nama_kategori')}}" >
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
