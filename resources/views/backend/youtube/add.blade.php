<x-template title="Faq">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Form Tambah Kontak</h5>
                            <div class="card-body">
                                <form action="{{route('kontak.store')}}" method="POST">
                                    @csrf
                                   
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Nama*</label>
                                        <input type="text" name="nama" id="nama" class="form-control" value="{{old('nama')}}" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Link*</label>
                                        <input type="text" name="link" id="link" class="form-control" value="{{old('link')}}" >
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Icon*</label>
                                        <input type="text" name="icon" id="icon" class="form-control" value="{{old('icon')}}" >
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
