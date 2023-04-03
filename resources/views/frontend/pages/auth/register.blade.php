@extends('frontend.layout.index')

@section('content')
    <!-- ======= Pricing Section ======= -->
    <section id="registrasi" class="registrasi">

        <div class="container" data-aos="fade-up">

            <div class="row gy-4" data-aos="fade-left">
                <div class="col-lg-10 col-md-12" data-aos="zoom-in" data-aos-delay="200" style="margin:auto;">
                    <div class="box">
                        <div class="text-center">
                            <img src="{{ '/' }}frontend/baru/images/logo_new.png"
                                style="margin:0 auto; width: 300px !important; padding: 0 !important;" alt="">
                           
                        </div>
                        <form action="{{ route('frontend.register.store') }}" class="px-2" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label for="" class="float-start fw-bold mb-1">Nama Member *</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                            placeholder="Masukan Nama Lengkap" value="{{ old('nama') }}">
                                        @error('nama')
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="float-start fw-bold mb-1">Email *</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukan Email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="float-start fw-bold mb-1"> Password *</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukan Password"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="float-start fw-bold mb-1">Ulangi Password *</label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                            placeholder="Ulangi Password" value="{{ old('password_confirmation') }}">
                                        @error('password_confirmation')
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label for="" class="float-start fw-bold mb-1">No Telepon / WhatsApp *</label>
                                        <input type="text" class="form-control @error('no_telpon') is-invalid @enderror" name="no_telpon" placeholder="Masukan No Telpon"
                                            value="{{ old('no_telpon') }}">
                                        @error('no_telpon')
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="float-start fw-bold mb-1">Provinsi *</label>
                                        <select name="id_provinsi" id="id_provinsi" class="form-control js-example-basic-single @error('id_provinsi') is-invalid @enderror">
                                            <option value="">Pilih Provinsi</option>
                                            @foreach ($provinsi as $item)
                                                <option value="{{ $item->id_provinsi }}">{{ $item->nama_provinsi }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_provinsi')
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="float-start fw-bold mb-1">Kota *</label>
                                        <select name="id_kota" id="id_kota" class="form-control js-example-basic-single1 @error('id_kota') is-invalid @enderror">
                                            <option value="">Pilih Kota</option>
                                            @foreach ($kota as $item)
                                                <option value="{{ $item->id_kota }}">{{ $item->nama_kota }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_kota')
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="float-start fw-bold mb-1">Tahu Idolapppk Dari Mana ? *</label>
                                        <select name="iklan_idolapppk" id="iklan_idolapppk" class="form-control @error('iklan_idolapppk') is-invalid @enderror">
                                            <option value="">Pilih Salah Satu</option>
                                            <option value="Google">Iklan Google</option>
                                            <option value="Youtube">Youtube</option>
                                            <option value="Instagram">Instagram</option>
                                            <option value="Facebook">Facebook</option>
                                            <option value="Tiktok">Tiktok</option>
                                            <option value="Kerabat Dekat">Kerabat Dekat</option>
                                        </select>
                                        @error('iklan_idolapppk')
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="float-start fw-bold mb-1">Kode Referal </label>
                                        <input type="text" class="form-control @error('kode_afiliasi') is-invalid @enderror" name="kode_afiliasi"
                                            placeholder="Kustom Kode Referal Anda" value="{{ old('kode_afiliasi') }}">
                                        @error('kode_afiliasi')
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" name="setuju" required value=""
                                            id="flexCheckChecked">
                                        <label class="form-check-label float-start" style="text-align:left;" for="flexCheckChecked">
                                            Dengan ini anda telah menyetujui segala peraturan dan ketentuan pada plaftorm ini
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn-buy btn btn-white mt-4">Register</button>
                                        <div class="form-group mt-3">
                                            <span>Sudah Punya Account ? <a href="{{ route('frontend.login') }}"
                                                    class="">Login</a></span>
                                        </div>
                                    </div>
                                    
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
