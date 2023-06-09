<x-template title="Instagram">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Instagram</h5>
                            <div class="card-body">
                                <form action="{{route('instagram.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Judul*</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="{{ old('title') }}" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Foto*</label>
                                        <input type="file" name="foto" id="foto" class="form-control"
                                            value="{{ old('foto') }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Deskripsi*</label>
                                        <input type="text" name="desk" id="desk" class="form-control"
                                            value="{{ old('desk') }}" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Link*</label>
                                        <input type="text" name="link" id="link" class="form-control"
                                            value="{{ old('link') }}" required>
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
