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
                                @php
                                    $id = App\Helper\HashHelper::encryptData($kategori->id);
                                @endphp
                                <form action="{{ route('kategori-paket.update', $id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Nama Kategori*</label>
                                        <input type="text" name="nama" id="nama" class="form-control" value="{{$kategori->nama ?? old('nama')}}" >
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="type" id="type" class="form-control">
                                            <option value="">-PILIH-</option>
                                            <option value="bimbel">Bimbel</option>
                                            <option value="mandiri">Mandiri</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Upload Banner</label>
                                        <input type="file" name="banner" id="banner" class="form-control">
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
    <script>
        $('#type').val('{{$kategori->type}}')
    </script>
</x-template>
