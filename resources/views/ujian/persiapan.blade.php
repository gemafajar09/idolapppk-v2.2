@extends('ujian.template')
@section('mainclient')
    <div class="container">
        <div class="row justify-content-center">
            {{-- <div class="col-md-8">
                <div class="alert alert-info">
                    <i class="fa fa-info btn btn-info btn-rounded"></i>
                    {{ $informasi ? $informasi->informasi : '' }}
                </div>
            </div> --}}
            <div class="col-md-4">
                <div class="card" style="border-radius:10px">
                    <div class="card-header text-center">
                        <h5>{{ __('Konfirmasi data Peserta') }}</h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('ujian-mulai') }}">
                            @csrf
                            <input type="hidden" id="waktu_mulais" name="waktu_mulai">
                            <input type="hidden" id="waktus" name="waktus">
                            <label><b>Nama Peserta:</b></label>
                            <span class="form-control">{{ session('nama') }}</span>
                            <label><b>Paket Ujian :</b></label>
                            <span class="form-control">{{ $paket->nama_paket }}</span>
                            <input type="hidden" id="id_paket" name="id_paket" value="{{ $paket->id }}">
                            <input type="hidden" id="id_fasilitas" name="id_fasilitas" value="{{ $id_fasilitas }}">
                            <br><br>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br><br>
    
    <script>
        var date = new Date();

        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var day = date.getDate();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds();
        
        $('#waktu_mulais').val(year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds);
        $('#waktus').val(hours + ":" + minutes + ":" + seconds);
    </script>
@endsection
