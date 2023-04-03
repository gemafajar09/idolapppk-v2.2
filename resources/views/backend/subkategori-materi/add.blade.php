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
                                <form action="{{route('subkategori-materi.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Nama Kategori*</label>
                                        <select name="id_kategori_materi" id="" class="form-control">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Nama Sub Kategori*</label>
                                        <input type="text" name="nama_subkategori" id="nama" class="form-control" value="{{old('nama_subkategori')}}" >
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Deskripsi Kategori*</label>
                                        <textarea name="deskripsi_subkategori" id="" cols="30" rows="2" class="form-control">
                                            {{old('deskripsi_subkategori')}}
                                        </textarea>
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
