<x-template title="Instagram">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Edit Instagram</h5>
                            <div class="card-body">
                                @php
                                    $id_instagram = App\Helper\HashHelper::encryptData($instagram->id);
                                @endphp
                                <form action="{{ route('instagram.update', $id_instagram) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Judul*</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="{{ $instagram->title ?? old('title') }}" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <img src='{{ asset("foto/$instagram->foto") }}' alt=""
                                            class="img-thumbnail" style="width: 100px;">
                                        <br>
                                        <label for="" class="mb-2">Foto*</label>
                                        <input type="file" name="foto" id="foto" class="form-control"
                                            value="{{ old('foto') }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Deskripsi*</label>
                                        <input type="text" name="desk" id="desk" class="form-control"
                                            value="{{ $instagram->desk ?? old('desk') }}" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Link*</label>
                                        <input type="text" name="link" id="link" class="form-control"
                                            value="{{ $instagram->link ?? old('link') }}" required>
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
