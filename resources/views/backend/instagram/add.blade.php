<x-template title="instagram">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Form Tambah instagram</h5>
                            <div class="card-body">
                                <form action="{{ route('instagram.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Paste Embed Disini</label>
                                        <input type="text" name="deskripsi" id="deskripsi" class="form-control"
                                            value="{{ old('deskripsi') }}" >
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
