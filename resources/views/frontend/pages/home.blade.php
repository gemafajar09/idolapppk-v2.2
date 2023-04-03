@extends('frontend.layout.index')
@section('hero')
@include('frontend.components.hero')
@endsection
@section('content')

<section id="about" class="about" style="background-color:#f6f9ff;">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0">

            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="content">
                    <h1 data-aos="fade-up" style="font-weight: bold;font-family: Arial, Helvetica, sans-serif;">Pendaftaran PPPK 2023 Akan Difokuskan Bagi Jabatan Fungsional.</h1>
                    <p>
                        Pemerintah melalui Kementerian Pendayagunaan Aparatur Negara dan Reformasi Birokrasi (Kemenpan RB) menetapkan 6 formasi Prioritas dalam pendaftaran CPNS dan PPPK 2023 yang tertuang pada Surat Edaran Nomor B/521/M.SM.01.00/2023. Pendaftaran CPNS 2023 dibuka bagi jabatan pelaksana yaitu Bidang Kejaksaan, Bidang Kehakiman, Bidang intelijen, dan Dosen. Sementara itu, Pendaftaran PPPK 2023 dibuka bagi jabatan fungsional. yaitu Guru dan Tenaga Kesehatan (NAKES). Maka persiapkan diri anda dan curi start dari pesaing !!!
                    </p>
                    <div class="text-center text-lg-start">
                        <a href="{{ route('frontend.register') }}"
                            class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                            <span>Daftar Gratis</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-1 d-flex align-items-center text-center" data-aos="zoom-out"
                data-aos-delay="200">
                <img src="{{ asset('frontend/assets/img/web/about.svg') }}" alt="" class="img-fluid">
            </div>

        </div>
    </div>

</section><!-- End About Section -->
<!-- ======= Features Section ======= -->
<section id="features" class="features">

    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <h2>Informasi Tambahan</h2>
            <p>Kenapa Harus Belajar Bersama IDOLA PPPK ?</p>
        </header>

        <div class="row">

            <div class="col-lg-6">
                <img src="{{ asset('frontend/assets/img/web/kenapa.svg') }}" class="img-fluid" alt="">
            </div>

            <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                <div class="row align-self-center gy-4">

                    <div class="col-md-12" data-aos="zoom-out" data-aos-delay="200">
                        <div class="feature-box d-flex align-items-center">
                            <i class="bi bi-check"></i>
                            <h3 style="font-size:130%;line-height:30px;text-align:justify;">Karena Simulasi Tryout IDOLA PPPK memberikan gambaran yang sangat mirip dengan tes PPPK sebenarnya sehingga mendukung proses persiapan menghadapi Seleksi CASN 2023, Bukan tanpa alasan semua materi kami susun berdasarkan dengan Kisi-Kisi Permenpan Terbaru.</h3>
                        </div>
                    </div>


                </div>
            </div>

        </div> <!-- / row -->


    </div>

</section><!-- End Features Section -->

<!-- ======= Services Section ======= -->
<section id="services" class="services" style="background-color:#f6f9ff;">

    <div class="container" data-aos="fade-up">

        <header class="section-header">

            <p>Fasilitas Yang Tersedia Di IDOLAPPPK</p>
        </header>
        <!-- Update Card Fasilitas-->
        <div class="row gy-4">

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <!-- Mengubah Card menjadi warna coklat -->
                <div class="service-box" style="background-color:#a87d5a;">
                    <!-- Mengubah icon menjadi coklat -->
                    <i class="ri-discuss-line icon" style="color:#a87d5a;"></i>
                    <!-- mengubah tulisan menjadi warna putih -->
                    <h4 style="color:white;">Try Out Simulasi CAT BKN</h4>
                    <p style="color:white;">Simulasi tryout CAT sangat mirip dengan tampilan Tryout CAT BKN,
                        termasuk bobot penilaian
                        Manajerial, Sosio Kultural, Wawancara telah disesuai dengan PERMENPAN-RB Terbaru dan
                        terkait manajemen waktu IDOLA PPPK juga menyediakan fasilitas waktu realtime sesuai CAT BKN,
                        Sehingga mempermudah agar semakin terbiasa menggunakan website saat menghadapi tes berbasis
                        computer/CAT yang resmi dari BKN.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-box" style="background-color:#a87d5a;">
                    <i class="ri-discuss-line icon" style="color:#a87d5a;"></i>
                    <h4 style="color:white;">Kisi-Kisi Terbaru</h4>
                    <p style="color:white;">Kisi-Kisi yang disediakan oleh IDOLA PPPK selalu update dan menyesuaikan
                        dengan kisi-kisi terbaru
                        terkait PPPK berdasarkan PERMENPAN-RB Terbaru tentang Pengadaan PEGAWAI PEMERINTAH DENGAN
                        PERJANJIAN KERJA Untuk Jabatan Fungsional.</p>

                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="service-box" style="background-color:#a87d5a;">
                    <i class="ri-discuss-line icon" style="color:#a87d5a;"></i>
                    <h4 style="color:white;">Materi dan Soal Terupdate</h4>
                    <p style="color:white;">Selain materi berbentuk teks tim juga menyediakan materi dalam bentuk video
                        (Tes Manajerial, Tes
                        Sosio-kultural, Pertanyaan Wawancara) Berdasarkan pemantauan Tim IDOLA PPPK sejak tahun 2019
                        kami sudah menyediakan materi dan Soal terbaru yang ada di lapangan agar membantu kamu
                        dalam memahami bentuk soal PPPK yang sering keluar di tahun-tahun sebelumnya sebagai persiapan
                        untuk menghadapi ujian CASN</p>

                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="service-box" style="background-color:#a87d5a;">
                    <i class="ri-discuss-line icon" style="color:#a87d5a;"></i>
                    <h4 style="color:white;">Grafik Statistik Hasil Tryout</h4>
                    <p style="color:white;">Kami melengkapi fitur evaluasi pembelajaran secara realtime untuk mengukur
                        tingkat pemahaman pada
                        suatu materi. Jenis evaluasi tersebut terkait hasil tryout yang akan ditampilkan dalam bentuk
                        grafik statistik sehingga mampu mengenali letak kelemahan pada bidang apa.</p>

                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="service-box" style="background-color:#a87d5a;">
                    <i class="ri-discuss-line icon" style="color:#a87d5a;"></i>
                    <h4 style="color:white;">Akses Belajar Fleksibel</h4>
                    <p style="color:white;">IDOLAPPPK sangat memahami kesibukan dari masing-masing individu
                        berbeda-beda, Maka dari itu kami
                        memberikan akses belajar yang cukup fleksibel yaitu tryout dapat diakses kapanpun dan di
                        manapun.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
                <div class="service-box" style="background-color:#a87d5a;">
                    <i class="ri-discuss-line icon" style="color:#a87d5a;"></i>
                    <h4 style="color:white;">Program Sedekah Bareng</h4>
                    <p style="color:white;">“Ingat Sedekah biar Berkah” Berdoa tanpa usaha itu lucu, Berusaha tanpa doa
                        itu sombong. Lulus
                        menjadi ASN adalah impian anda, jemput impian mu dengan keajaiban sedekah dan lampirkan do’a
                        terbaik mu untuk kelulusan tes CASN tahun ini. Yuk, kami mengajak bersama untuk mulai rajin
                        sedekah biar rezeki makin berkah.</p>
                </div>
            </div>
            <!-- Selesai mengubah update tampilan card -->
        </div>

    </div>

</section><!-- End Services Section -->

<!-- ======= Pricing Section ======= -->
<section id="pricing" class="pricing">

    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <p>Paket Unggulan IDOLA PPPK</p>
        </header>
        <div class="row gy-4" data-aos="fade-left">
            @foreach ($paket as $item)
            <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="card">
                    <div class="card-body">
                        <h4 style="color: #000;" class="mt-3 mb-4 fw-bold text-center">{{ $item->nama_paket }}
                        </h4>
                        <hr>
                        @if (!empty($item->harga_coret) || $item->harga_coret != 0)
                        <!-- Mengubah warna pada harga paket harga -->
                        <div class="price1 text-center" style="color: #a87d5a">
                            <sup>Rp.</sup><del>{{ number_format($item->harga_coret) }}</del>
                        </div>
                        @endif
                        <!-- mengubah warna paket harga -->
                        <div class="price text-center" style="color: #a87d5a">
                            <sup>Rp.</sup>{{ number_format($item->harga_paket) }}<span>
                                /{{ $item->masa_aktif }} Bulan</span>
                        </div>
                        <hr>
                        @foreach ($item->fasilitas as $fasilitas)
                        <div class="row mb-2">
                            <div class="col-lg-1 col-2">
                                <!-- mengubah button ceklis daftar fasilitas -->
                                <i class="bi bi-check-lg bg-dark text-white rounded px-1"></i>
                            </div>
                            <div class="col-lg-11 col-10">
                                <span style="text-align: left;color:black;">
                                    {{ $fasilitas->nama_fasilitas }}</span>
                            </div>
                        </div>
                        @endforeach
                        <form action="{{ route('frontend.keranjang.proses') }}" method="POST" class="text-center">
                            @csrf
                            <input type="hidden" name="id_paket"
                                value="{{ App\Helper\HashHelper::encryptData($item->id) }}">
                            <div class="d-grid gap-2">
                                 <!--mengubah button dan warna tulisan beli sekarang -->
                                <button type="submit" class="btn btn-outline-light mt-4" style="background-color: #a87d5a;">Beli
                                    Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach




        </div>

    </div>

</section>
<!-- End Pricing Section -->

<!-- ======= Values Section ======= -->
{{-- <section id="values" class="values" style="background-color:#f6f9ff;">

    <div class="container" data-aos="fade-up">

        <header class="section-header" style="padding-bottom:0px;">
            <h2>Afiliasi</h2>
            <p>Dapatkan Komisi Sebesar 25% dari Setiap Penjualan Paket yang Menggunakan Kode Referral Anda.</p>
        </header>

        <div class="row">

            <div class="col-lg-12 text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="mb-4">
                    <img src="{{ asset('frontend/assets/img/web/afiliasi.svg') }}" class="img-fluid" alt="">
                </div>
                <h3>Program Affiliasi Award
                    Periode Transaksi 1 Maret - 31 Desember 2022
                </h3>
                <p>Selain mendapatkan Komisi 25% dari setiap penjualan, Mitra Affiliasi juga berhak mendapatkan hadiah
                    Affiliasi Award sesuai minimum penjualan yang dicapai selama periode program dan Raih total Hadiah
                    hingga Ratusan Juta.</p>

            </div>

        </div>

    </div>

</section><!-- End Values Section --> --}}

@include('frontend.components.faq')

<section id="portfolio" class="portfolio video-youtube" style="background-color:#f6f9ff;">

    <div class="container" data-aos="fade-up">

        <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-12 col-12 col-md-12">
                <div class="ratio ratio-16x9">
                    <iframe src="{{$youtube->link}}?rel=0" title="YouTube video" allowfullscreen></iframe>
                </div>
            </div>
        </div>


    </div>


</section>
@endsection