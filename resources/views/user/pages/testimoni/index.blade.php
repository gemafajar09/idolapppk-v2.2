@extends('user.layout.app')

@section('content')
    <div class="pagetitle">
        <h1>Histori Testimoni</h1>
        
    </div>
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Buat Testimoni</h5>
                                    <form action="{{ route('testimoni.store') }}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Nama"
                                                    aria-label="Nama" name="nama">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Umur"
                                                    aria-label="Umur" name="umur">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Alamat"
                                                    aria-label="Alamat" name="alamat">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Formasi"
                                                    aria-label="Formasi" name="formasi">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <textarea name="testimoni" id="" cols="2" rows="2" class="form-control" placeholder="Masukan Testimoni"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <button class="btn btn-success btn-sm" type="submit">Tambah</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body p-3">
                                    <div class="table-responsive">
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Umur</th>
                                                    <th scope="col">Alamat</th>
                                                    <th scope="col">Formasi</th>
                                                    <th scope="col">Testimoni</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($testimoni as $key => $item)
                                                    <tr>
                                                        <th scope="row">{{ $key + 1 }}</th>
                                                        <td>{{ $item->nama }}</td>
                                                        <td>{{ $item->umur }}</td>
                                                        <td>{{ $item->alamat }}</td>
                                                        <td>{{ $item->formasi }}</td>
                                                        <td>{{ $item->testimoni }}</td>


                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
