<x-template title="Iklan">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Form Tambah Iklan</h5>
                            <div class="card-body">
                                @php
                                    $id_iklan = App\Helper\HashHelper::encryptData($iklan->id);
                                @endphp
                                <form action="{{ route('iklan.update', $id_iklan) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group mb-2">
                                        <img src='{{ asset("foto/$iklan->foto") }}' alt="" class="img-thumbnail"
                                            style="width: 100px;">
                                        <br>
                                        <label for="" class="mb-2">Foto*</label>
                                        <input type="file" name="foto" id="foto" class="form-control"
                                            value="{{ old('foto') }}">
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Link*</label>
                                        <input type="text" name="link" id="link" class="form-control"
                                            value="{{ $iklan->link ?? old('link') }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Deskripsi</label>
                                        <input type="text" name="deskripsi" id="deskripsi" class="form-control"
                                            value="{{ $iklan->deskripsi ?? old('deskripsi') }}">
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
