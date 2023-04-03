@extends('frontend.layout.index')

@section('content')

    <!-- ======= Pricing Section ======= -->
    <section id="registrasi" class="registrasi">
        
        <div class="container" data-aos="fade-up">
            @include('frontend.components.alert')
            <div class="row gy-4" data-aos="fade-left">
                
                <div class="col-lg-6 col-md-12" data-aos="zoom-in" data-aos-delay="200" style="margin:auto;">
                    <div class="box">
                        <div class="text-center">
                            <img src="{{('/')}}frontend/baru/images/logo_new.png" class="img-fluid img-responsive" alt="">
                        </div>
                        <form action="{{route('password-update',$id_pengguna)}}" class="px-2" method="POST">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="" class="float-start fw-bold mb-1">New Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="********" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="" class="float-start fw-bold mb-1">Repeat Password</label>
                                    <input type="password" class="form-control" name="password1" placeholder="********" required>
                            </div>
                            
                            <button class=" btn btn-primary mt-4" style="width:100%">Reset Sekarang</button>
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </section>
    <!-- End Pricing Section -->
@endsection
