<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="{{ asset('frontend/baru/images/logo.png') }}" class="img-fluid" alt="header.png">
            {{-- <span>FlexStart</span> --}}
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="{{ route('frontend.index') }}">Beranda</a></li>
                <li><a class="nav-link scrollto" href="{{ route('frontend.paketAll') }}">Paket Tersedia</a></li>
                <li class="dropdown"><a href="#"><span>Service</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{route('frontend.service.paketSaya')}}">Paket Saya</a></li>
                        <li><a href="#">Hasil Try Out</a></li>
                        <li><a href="#">Try Out Gratis</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="{{ route('frontend.keranjang') }}">Pembelian</a></li>
                <li class="dropdown"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        @php
                            $id_pengguna = App\Helper\HashHelper::encryptData(session('id_pengguna'));
                        @endphp
                        <li><a href="{{route('frontend.historipembelian',$id_pengguna)}}">Histori Pembelian</a></li>
                        <li><a href="{{route('frontend.pencairan.afiliasi')}}">Pencairan Saldo</a></li>
                        <li><a href="{{route('frontend.profileSaya',$id_pengguna)}}">Lihat Profile Saya</a></li>
                        <li><a href="{{route('frontend.ubahPasswordSaya',$id_pengguna)}}">Ubah Password</a></li>
                        
                    </ul>
                </li>
                <li><a class="getstarted scrollto" href="{{ route('frontend.logout') }}">Logout</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>
