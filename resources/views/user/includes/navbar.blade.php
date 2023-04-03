<style>
    .custom {
        z-index: 99999;
    }
</style>
@php
    $id_pengguna = App\Helper\HashHelper::encryptData(session('id_pengguna'));
@endphp
<div class="lg:hidden flex fixed bg-white px-2 shadow bottom-0 left-0 w-full justify-around items-center custom">
    <div class="flex-1">
        <a class="flex flex-col hover:text-[#9e6924] py-2 gap-1 items-center" href="{{ route('frontend.index') }}">
            <i class="bi bi-grid text-xl"></i>
            <span class="text-xs">Beranda</span>
        </a>
    </div>
    <div class="flex-1">
        <a class="flex flex-col hover:text-[#9e6924] py-2 gap-1 items-center" href="{{ route('frontend.tryout-akbar') }}">
            <i class="bi bi-clipboard-data text-xl"></i>
            <span class="text-xs">Tryout Akbar</span>
        </a>
    </div>
    <div class="flex-1">
        <a class="flex flex-col hover:text-[#9e6924] py-2 gap-1 items-center" href="{{ route('frontend.paketKategori') }}">
            <i class="bi bi-cart text-3xl"></i>
            <span class="text-xs font-semibold">Beli Paket</span>
        </a>
    </div>
    <div class="flex-1">
        <a class="flex flex-col hover:text-[#9e6924] py-2 gap-1 items-center" href="{{ route('frontend.service.paketSaya') }}">
            <i class="bi bi-file-earmark-text text-xl"></i>
            <span class="text-xs">Paket Saya</span>
        </a>
    </div>
    <div class="flex-1">
        <a class="flex flex-col hover:text-[#9e6924] py-2 gap-1 items-center" href="{{ route('frontend.profileSaya', $id_pengguna) }}">
            <i class="bi bi-file-person text-xl"></i>
            <span class="text-xs">Akun</span>
        </a>
    </div>
</div>
