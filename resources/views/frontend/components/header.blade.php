<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="{{route('frontend.index')}}" class="logo d-flex align-items-center">
            <img src="{{ asset('frontend/baru/images/logo.png') }}" class="img-fluid" alt="header.png">
            {{-- <span>FlexStart</span> --}}
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="{{route('frontend.index')}}#hero">Beranda</a></li>
                <li><a class="nav-link scrollto" href="{{route('frontend.index')}}#about">Tentang Kami</a></li>
                <li><a class="nav-link scrollto" href="{{route('frontend.index')}}#services">Fasilitas</a></li>
                <li><a class="nav-link scrollto" href="{{route('frontend.index')}}#pricing">Paket Harga</a></li>
                <li><a class="nav-link scrollto" href="{{route('frontend.index')}}#faq">FAQ</a></li>
                <li><a class="nav-link scrollto" href="{{route('frontend.artikel')}}">Artikel</a></li>
                <li><a class="nav-link scrollto" href="{{route('frontend.login')}}">Login</a></li>
                <li><a class="getstarted scrollto" href="{{route('frontend.register')}}">Daftar Sekarang</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header>
