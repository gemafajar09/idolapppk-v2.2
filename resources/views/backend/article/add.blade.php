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
                                        <label for="" class="mb-2">Foto Citation*</label>
                                        <input type="text" name="foto_cite" id="foto_cite" class="form-control"
                                            value="{{ old('foto_cite') }}" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Tag*</label>
                                        <input type="text" name="tags" onkeyup="lowercase('tags')" id="tags" class="form-control"
                                            value="{{ old('tag') }}" required>
                                    </div>
                                    <script>
                                        function lowercase(selector) {
                                            var x = document.getElementById(selector).value;
                                            document.getElementById(selector).value = x.toLowerCase();
                                        }
                                    </script>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Isi Artikel*</label>
                                        <!-- TinyMCE Editor -->
                                        <textarea class="tinymce-editor" name="isi">
                                        </textarea><!-- End TinyMCE Editor -->
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Tipe Artikel*</label>
                                        <select name="tipe" id="tipe" class="form-control">
                                            <option value="1">Direkomendasikan</option>
                                            <option value="0">Tidak Direkomendasikan</option>
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
