@extends('frontend.layout.index')

@section('content')
    <style>
        .header, footer {
            display: none !important;
        }

        a {
            color: #9e6924 !important;
        }

        .btn-primary {
            background-color: #9e6924 !important;
            border: 2px solid white !important;
            padding: 10px 0;
        }

        .btn-primary:hover {
            border: 2px solid #9e6924 !important;
            background-color: white !important;
            color: #9e6924 !important;
        }
    </style>

    <!-- ======= Pricing Section ======= -->
    <section id="registrasi" class="registrasi">

        <div class="container">
            @include('frontend.components.alert')
            <div class="row gy-0">

                <div class="col-lg-5 col-xl-4 col-md-12" style="margin:auto;">
                    <div class="box">
                        <div class="text-center">
                            <img src="{{ '/' }}frontend/baru/images/logo_new.png"
                                style="margin:0 auto; width: 300px !important; padding: 0 !important;" alt="">
                            <div class="text-center font-bold text-lg">
                                Login ke Akun Anda
                            </div>
                        </div>
                        <form action="{{ route('frontend.login.store') }}" class="px-2" method="POST">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="" class="float-start font-semibold text-sm mb-1">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="" class="float-start font-semibold text-sm mb-1"> Password</label>
                                <input type="password" class="form-control" name="password" placeholder="" required>
                            </div>
                            <div class="flex justify-between" style="margin: 20px 0;font-size: 14px;">
                                <div class="form-group">
                                    <div>Belum Punya Akun?</div>
                                    <a href="{{ route('frontend.register') }}" class="">Daftar Sekarang!</a>
                                </div>
                                <div class="form-group text-right">
                                    <div>Lupa Password ?</div>
                                    <a href="#" onclick="bukax()" role="button" class="">Reset Sekarang!</a>
                                </div>
                            </div>
                            <button class=" btn btn-primary rounded-lg" style="width:100%">Masuk</button>
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </section>

    <!-- Modal -->

    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reset Password Idola PPPK</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('frontend.reset.password') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="email font-semibold text-sm">Email</label>
                        <input type="email" name="email" placeholder="" class="form-control my-1">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary rounded-lg" style="width:100%;">Kirim Link Reset
                            Password</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        function bukax() {
            $('#myModal').modal('show')
        }
    </script>
@endsection

<!-- tailwindcss -->
<script src="https://cdn.tailwindcss.com"></script>
