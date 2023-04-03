@php
    $id_pengguna = App\Helper\HashHelper::encryptData(session('id_pengguna'));
@endphp
<aside id="sidebar" class="sidebar hidden lg:block">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link hover:!bg-[#9e6925] collapsed" href="{{ route('frontend.index') }}">
                <i class="bi bi-grid"></i>
                <span class="font-semibold pl-3">Beranda</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link hover:!bg-[#9e6925] collapsed" href="{{ route('frontend.paketKategori') }}">
                <i class="bi bi-cart"></i>
                <span class="font-semibold pl-3">Beli Paket</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link hover:!bg-[#9e6925] collapsed" href="{{ route('frontend.tryout-akbar') }}">
                <i class="bi bi-file-earmark-text"></i>
                <span class="font-semibold pl-3">Try Out Akbar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link hover:!bg-[#9e6925] collapsed" href="{{ route('frontend.historipembelian', $id_pengguna) }}">
                <i class='bx bx-shopping-bag' ></i>
                <span class="font-semibold pl-3">Pembelian</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link hover:!bg-[#9e6925] collapsed" href="{{ route('frontend.service.paketSaya') }}">
                <i class="bi bi-file-earmark-text"></i>
                <span class="font-semibold pl-3">Paket Saya</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link hover:!bg-[#9e6925] collapsed" href="{{ route('frontend.profileSaya', $id_pengguna) }}">
                <i class='bi bi-file-person text-xl'></i>
                <span class="font-semibold pl-3">Akun</span>
            </a>
        </li>

    </ul>
</aside>
