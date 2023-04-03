<x-template title="Artikel">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Form Tambah Artikel</h5>
                            <div class="card-body">
                                <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Judul*</label>
                                        <input type="text" name="judul" id="judul" class="form-control"
                                            value="{{ old('judul') }}" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Foto*</label>
                                        <input type="file" name="foto" id="foto" class="form-control"
                                            value="{{ old('foto') }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Isi Artikel*</label>
                                        <!-- TinyMCE Editor -->
                                        <textarea class="tinymce-editor" name="isi">
                                        </textarea><!-- End TinyMCE Editor -->

                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Tipe Artikel*</label>
                                        <select name="tipe" id="tipe" class="form-control">
                                            <option value="artikel">Artikel</option>
                                            <option value="sedekah">Sedekah</option>
                                        </select>
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
