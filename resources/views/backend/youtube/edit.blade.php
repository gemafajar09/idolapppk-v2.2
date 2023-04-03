<x-template title="Youtube">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Form Edit</h5>
                            <div class="card-body">
                                @php
                                    $id_youtube = App\Helper\HashHelper::encryptData($youtube->id);
                                @endphp
                                <form action="{{ route('youtube.update', $id_youtube) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-2">Link*</label>
                                        <input type="text" name="link" id="link" class="form-control" value="{{$youtube->link ?? old('link')}}" >
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
