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
                                    $id = App\Helper\HashHelper::encryptData($subkategori->id);
                                @endphp
                                <form action="{{ route('subkategori-materi.update', $id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Nama Kategori*</label>
                                        <select name="id_kategori_materi" id="id_kategori_materi" class="form-control">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                                            @endforeach
                                        </select>
                                        <script>
                                            document.getElementById('id_kategori_materi').value = '{{$subkategori->id_kategori_materi}}'
                                        </script>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Nama Sub Kategori*</label>
                                        <input type="text" name="nama_subkategori" id="nama" class="form-control" value="{{$subkategori->nama_subkategori ?? old('nama_subkategori')}}" >
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Deskripsi Kategori*</label>
                                        <textarea name="deskripsi_subkategori" id="" cols="30" rows="2" class="form-control">
                                            {{$subkategori->deskripsi_subkategori ?? old('deskripsi_subkategori')}}
                                        </textarea>
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
