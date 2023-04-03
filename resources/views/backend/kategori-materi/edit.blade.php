<x-template title="Kategori Materi">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Form Tambah</h5>
                            <div class="card-body">
                                @php
                                    $id = App\Helper\HashHelper::encryptData($kategori->id);
                                @endphp
                                <form action="{{ route('kategori-materi.update', $id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Kode Kategori*</label>
                                        <input type="text" name="kode_kategori" id="nama" class="form-control" value="{{$kategori->kode_kategori ?? old('kode_kategori')}}" >
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Nama Kategori*</label>
                                        <input type="text" name="nama_kategori" id="nama" class="form-control" value="{{$kategori->nama_kategori ?? old('nama_kategori')}}" >
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
