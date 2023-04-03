@extends('frontend.layout.index')

@section('content')
    @include('frontend.components.breadcumb',['title'=>"Halaman Profile",'subtitle'=>"Profile"])
    <!-- ======= Pricing Section ======= -->
    <section id="detail" class="profile-saya">

        <div class="container-fluid" data-aos="fade-up">

            <div class="row gy-4" data-aos="fade-left">
                <div class="col-lg-4 col-md-12 col-12" data-aos="zoom-in" data-aos-delay="200">
                    <div class="box">
                        <h3>Profile Saya</h3>
                        <div>
                            <img src="{{ asset('frontend/baru/images/profile.svg') }}" alt="profile.png"
                                style="width: 35%;">
                        </div>
                        <div class="mt-3">
                            <p>Saldo Afiliasi : Rp. {{ number_format($pengguna->saldo_afiliasi) }}</p>
                        </div>
                        <div class="mt-4">
                            <a href="" class="btn-buy" style="width: 70%">Ubah Password</a>
                        </div>
                        <div class="mt-3">
                            <a href="" class="btn-buy" style="width: 70%">Logout</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12" data-aos="zoom-in" data-aos-delay="200">
                    <div class="box">
                        @php
                            $id_pengguna = App\Helper\HashHelper::encryptData(session('id_pengguna'));
                        @endphp
                        <form action="{{route('frontend.updateProfileSaya',$id_pengguna)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-2">
                                <div class="col-md mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingInputGrid"
                                            placeholder="Masukan Nama Lengkap" name="nama" value="{{ $pengguna->nama }}">
                                        <label for="floatingInputGrid">Nama Lengkap</label>
                                    </div>
                                </div>
                                <div class="col-md mb-4">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="floatingInputGrid"
                                            placeholder="ex. adi@gmail.com" name="email" value="{{ $pengguna->email }}">
                                        <label for="floatingInputGrid">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingInputGrid"
                                            placeholder="Masukan Kode Afiliasi" name="kode_afiliasi" value="{{ $pengguna->kode_afiliasi }}">
                                        <label for="floatingInputGrid">Kode Afiliasi</label>
                                    </div>
                                </div>
                                <div class="col-md mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingInputGrid"
                                            placeholder="Masukan No Telpon" name="no_telpon" value="{{ $pengguna->no_telpon }}">
                                        <label for="floatingInputGrid">No Telpon</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingInputGrid"
                                            placeholder="Informasi Bank" name="informasi_bank" value="{{ $pengguna->informasi_bank }}">
                                        <label for="floatingInputGrid">Informasi Bank</label>
                                    </div>
                                </div>
                                <div class="col-md mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingInputGrid"
                                            placeholder="Masukan No Rekening" name="no_rekening" value="{{ $pengguna->no_rekening }}">
                                        <label for="floatingInputGrid">No Rekening</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md mb-4">
                                    <div class="form-floating">
                                        <select class="form-select js-example-basic-single" id="id_provinsi"
                                            aria-label="Floating label select example" name="id_provinsi">
                                            @foreach ($provinsi as $item)
                                                <option value="{{ $item->id_provinsi }}">{{ $item->nama_provinsi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="floatingSelectGrid">Pilih Provinsi</label>
                                        <script>
                                            $('#id_provinsi').val('{{$pengguna->id_provinsi}}').trigger('change');
                                        </script>
                                    </div>
                                </div>
                                <div class="col-md mb-4">
                                    <div class="form-floating">
                                        <select class="form-select js-example-basic-single" id="id_kota"
                                            aria-label="Floating label select example" name="id_kota">
                                            @foreach ($kota as $item)
                                                <option value="{{ $item->id_kota }}">{{ $item->nama_kota }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingSelectGrid">Pilih Kota</label>
                                        <script>
                                            $('#id_kota').val('{{$pengguna->id_kota}}').trigger('change');
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md mb-4 ">
                                    <div class="form-floating float-start">
                                        <button type="submit" class="btn btn-success">Update Profile</button>
                                    </div>
                                </div>
                                <div class="col-md mb-4">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </section>
    <!-- End Pricing Section -->
@endsection
