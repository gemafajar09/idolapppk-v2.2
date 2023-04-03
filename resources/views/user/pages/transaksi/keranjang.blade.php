@extends('user.layout.app')
@section('title', 'IdolaPPPK - Keranjang')

@section('content')
    <div class="pagetitle">
        <h1>Keranjang</h1>

    </div>

    <section class="section dashboard">

        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="card">
                                <div class="card-body p-3">
                                    @if (empty($tmp))
                                        <div class="text-center">
                                            <i class="bi bi-cart-x-fill" style="font-size: 88px;"></i>
                                            <h3>{{ 'Keranjang Kosong' }}</h3>
                                        </div>
                                    @else
                                        @php
                                            $harga_asli = $tmp->harga_coret ?? 0;
                                            $harga_afiliasi = $tmp->harga ?? 0;

                                            if (session()->has('kode_afiliasi')) {
                                                $harga = $harga_afiliasi;
                                            } else {
                                                $harga = $harga_asli;
                                            }
                                        @endphp

                                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                            </symbol>
                                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                            </symbol>
                                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </symbol>
                                        </svg>

                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                                aria-label="Info:">
                                                <use xlink:href="#info-fill" />
                                            </svg>
                                            <strong style="font-size: 20px;">Pemberitahuan</strong>
                                            <ul class="ms-3 mt-2">
                                                <li>Dapatkan potongan sebesar 30.000 dengan memasukkan kode referal</li>
                                                <li>Pembelian paket akan mendapatkan update soal</li>
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                        <div>
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Informasi</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Tryout / Latihan</button>
                                                </li>
                                                <!-- <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Jadwal</button>
                                                </li> -->
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th>Paket</th>
                                                                <td>{{ $tmp->paket->nama_paket ?? '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Harga</th>
                                                                <td>
                                                                    @if (session()->has('kode_afiliasi'))

                                                                        @if (!empty(session('kode_afiliasi')))
                                                                            Rp. <del>{{ number_format($harga_asli) }}</del>
                                                                        @endif
                                                                    @endif
                                                                    Rp. {{ number_format($harga) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Isi Paket</th>
                                                                <td>
                                                                    @php
                                                                        $fasilitas_paket = $tmp->paket->fasilitas ?? [];
                                                                    @endphp
                                                                    @foreach ($fasilitas_paket as $fasilitas)
                                                                        <div class="pb-2"><span><i
                                                                                    class="bi bi-check-lg bg-success text-white rounded" style="padding: 0 5px 0 5px;"></i>
                                                                            </span> <span style="font-size: .8em;">{{ $fasilitas->nama_fasilitas ?? '' }}</span>
                                                                        </div>
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Masa Aktif</th>
                                                                <td>{{ $tmp->masa_aktif }} Bulan</td>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                    <div class="flex flex-col gap-2 p-3">
                                                        @foreach ($materi as $i => $x)
                                                            <div class="flex items-center gap-3">
                                                                <div class="bg-[#9d8069] text-white w-14 h-14 text-xl rounded-xl flex justify-center items-center">
                                                                    <i class="bi bi-clipboard"></i>
                                                                    </div>
                                                                <div>
                                                                    <div class="font-semibold">
                                                                        Tryout {{ $x->materi }}
                                                                    </div>
                                                                    <!-- <div class="flex gap-3 text-sm">
                                                                        <div>
                                                                            <i class="bi bi-clock"></i>
                                                                            120 menit
                                                                        </div>
                                                                        <div>
                                                                            <i class="bi bi-clipboard"></i>
                                                                            200 soal
                                                                        </div>
                                                                    </div> -->
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                                    <div class="flex flex-col gap-2 p-3">
                                                        @foreach ([1,2,3,4,5] as $x)
                                                            <div class="flex items-center gap-3">
                                                                <div class="bg-[#9d8069] text-white w-14 h-14 text-xl rounded-full flex justify-center items-center">
                                                                    {{$x}}
                                                                </div>
                                                                <div>
                                                                    <div class="font-semibold">
                                                                        Jadwal {{ $x }} (Data Test)
                                                                    </div>
                                                                    <div class="flex gap-3 text-sm">
                                                                        Rabu, 30 Januari 2023 19:30 WIB
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form class="row mb-2"
                                            action="{{ route('frontend.keranjang.setKodeAfiliasi') }}" method="POST">
                                            @csrf
                                            <div class="col-6 mb-2">
                                                <label for="staticEmail2" class="visually-hidden">kode Referal</label>
                                                <input type="text" class="form-control" id="staticEmail2"
                                                    placeholder="Masukan Kode Referal" name="kode_afiliasi"
                                                    value="{{ session('kode_afiliasi') }}">
                                                @if (session()->has('kode_afiliasi'))
                                                    @if (!empty(session('kode_afiliasi')))
                                                        <small class="text-danger">*Selamat anda mendapat Diskon Rp 30.000</small>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                @if (session()->has('kode_afiliasi'))
                                                    @if (!empty(session('kode_afiliasi')))
                                                        <a href="{{ route('frontend.checkout.removeKodeAfiliasi') }}"
                                                            class="btn btn-danger btn-sm">X</a>
                                                    @endif
                                                @endif
                                                <button type="submit" class="btn btn-success text-green-700">Gunakan Kode</button>

                                            </div>
                                        </form>

                                        <form action="{{ route('frontend.checkout.proses') }}" method="POST">
                                            @csrf
                                            <div class="flex justify-end">
                                                <button type="submit" class="btn flex gap-2 items-center btn-primary text-blue-700 btn-block btn-md">
                                                    <i class='bx bxs-cart text-2xl' ></i>
                                                    Pembayaran
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection
