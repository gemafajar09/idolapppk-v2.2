<section id="hero" class="hero d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up" style="font-weight: bold;font-family: Arial, Helvetica, sans-serif;">Seleksi CASN 2023 Sudah Di Depan Mata</h1>
                <h5 data-aos="fade-up" data-aos-delay="400" class="mt-2">IDOLAPPPK.com merupakan flatporm yang menyediakan paket belajar lengkap dari mulai, simulasi Tryout berbasis CAT sesuai CAT BKN dan Pioner menerbitkan Buku PPPK Perawat, Buku PPPK Tenaga Kesehatan, Buku PPPK Keguruan, dan Buku PPPK Umum MANSOSWAW.</h5>
                <div data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center text-lg-start">
                        @if (empty(session('id_pengguna')))
                            <a href="{{ route('frontend.login') }}"
                                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Mulai Sekarang</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @else
                            <a href="{{ route('frontend.service.paketSaya') }}"
                                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Paket Saya</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{ asset('frontend/baru/images/hero.svg') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>

</section>
