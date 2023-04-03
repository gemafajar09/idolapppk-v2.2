@extends('frontend.layout.index')

@section('content')
    @include('frontend.components.breadcumb',['title'=>"Halaman Profile",'subtitle'=>"Profile"])
    <!-- ======= Pricing Section ======= -->
    <section id="detail" class="profile-saya">

        <div class="container" data-aos="fade-up">

            <div class="row gy-4" data-aos="fade-left">
                <div class="col-lg-6 col-md-12 col-12" data-aos="zoom-in" data-aos-delay="200" style="margin:auto;">
                    <div class="box">
                        <h3>Ubah Password</h3>
                        <div>
                            <img src="{{ asset('frontend/baru/images/profile.svg') }}" alt="profile.png"
                                style="width: 35%;">
                        </div>
                        @php
                            $id_pengguna = App\Helper\HashHelper::encryptData(session('id_pengguna'));
                        @endphp
                        <form action="{{ route('frontend.updatePasswordSaya',$id_pengguna) }}" class="px-3" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-2">
                                <label for="" class="float-start fw-bold mb-1">Password Sekarang</label>
                                <input type="password" class="form-control @error('password_sekarang') is-invalid @enderror" name="password_sekarang"
                                    placeholder="Masukan Password Sekarang" value="{{ old('password_sekarang') }}">
                                @error('password_sekarang')
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="float-start fw-bold mb-1">Password Baru</label>
                                <input type="password" class="form-control @error('password_baru') is-invalid @enderror" name="password_baru"
                                    placeholder="Masukan Password Baru" value="{{ old('password_baru') }}">
                                @error('password_baru')
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="float-start fw-bold mb-1">Password Confirmation</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                    placeholder="Masukan Password Confirmation" value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn-buy btn btn-white mt-4">Update Password</button> 
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <!-- End Pricing Section -->
@endsection
