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
                                @php
                                    $id_kontak = App\Helper\HashHelper::encryptData($kontak->id);
                                @endphp
                                <form action="{{ route('kontak.update', $id_kontak) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Nama*</label>
                                        <input type="text" name="nama" id="nama" class="form-control" value="{{$kontak->nama ?? old('nama')}}" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Link*</label>
                                        <input type="text" name="link" id="link" class="form-control" value="{{$kontak->link ?? old('link')}}" >
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Icon*</label>
                                        <input type="text" name="icon" id="icon" class="form-control" value="{{$kontak->icon ?? old('icon')}}" >
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
