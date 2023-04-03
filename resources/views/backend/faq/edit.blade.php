<x-template title="Faq">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Form Tambah Faq</h5>
                            <div class="card-body">
                                @php
                                    $id_faq = App\Helper\HashHelper::encryptData($faq->id);
                                @endphp
                                <form action="{{ route('faq.update', $id_faq) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Pertanyaan Faq*</label>
                                        <input type="text" name="pertanyaan" id="pertanyaan" class="form-control" value="{{$faq->pertanyaan ?? old('pertanyaan')}}" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Jawaban Faq*</label>
                                        <input type="text" name="jawaban" id="jawaban" class="form-control" value="{{$faq->jawaban ?? old('jawaban')}}" >
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
