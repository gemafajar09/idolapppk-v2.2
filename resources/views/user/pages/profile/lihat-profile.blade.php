@extends('user.layout.app')
@section('title', 'IdolaPPPK - Lihat Profile')
@php
    $id_pengguna = App\Helper\HashHelper::encryptData(session('id_pengguna'));
@endphp
@section('content')
    <!--  Set true to use new desain -->
    @if(true)
        <div class="flex flex-col lg:flex-row gap-3 lg:items-start container">
            <div>
                <div class="bg-[#9e6925] lg:bg-white border rounded-lg text-white lg:!text-black w-full lg:w-[450px] pb-32">
                    <h2 class="text-xl text-center lg:!text-left p-3">Akun Saya</h2>
                    <div class="flex gap-3 items-center">
                        <div class="p-3">
                            <img src="https://ui-avatars.com/api/?name={{$pengguna->nama}}&background=9e6925&color=fff" class="rounded-full hidden lg:block" />
                            <img src="https://ui-avatars.com/api/?name={{$pengguna->nama}}&background=fff&color=9e6925" class="rounded-full lg:hidden block" />
                        </div>
                        <div>
                            <h2 class="text-xl">{{ ucwords($pengguna->nama) }}</h2>
                            <p class="text-sm opacity-50">{{ $pengguna->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="-mt-28 px-3">
                    <div class="bg-white w-full rounded-lg p-2 border">
                        <div onclick="menu('profile')" class="profile cursor-pointer hover:ml-1 transition text-md flex items-center gap-2 p-2 border-b bg-[#9e6925] rounded-lg text-white">
                            <i class='bx bxs-face text-2xl'></i>
                            Profile
                        </div>
                        <a href="{{ route('frontend.historipembelian', $id_pengguna) }}" class="cursor-pointer hover:ml-1 transition text-md flex items-center gap-2 p-2 border-b">
                            <i class='bx bx-shopping-bag text-2xl'></i>
                            Pembelian
                        </a>
                        <a href="{{route('frontend.pencairan.afiliasi.award') }}" class="cursor-pointer hover:ml-1 transition text-md flex items-center gap-2 p-2 border-b">
                            <i class='bx bx-link text-2xl'></i>
                            Referal & Afiliasi
                        </a>
                        <div onclick="menu('ubhpassword')" class="ubhpassword cursor-pointer hover:ml-1 transition text-md flex items-center gap-2 p-2 border-b">
                            <i class='bx bxs-key text-2xl'></i>
                            Ubah Password
                        </div>
                        <a href="{{ route('frontend.logout') }}" class="cursor-pointer hover:ml-1 transition text-md flex items-center gap-2 p-2 border-b text-red-500">
                            <i class='bx bx-log-out text-2xl'></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
            <div class="rounded-lg border p-3 flex-1 bg-white">
                <div id="profile">
                <form action="{{route('frontend.updateProfileSaya',$id_pengguna)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-2">
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputGrid"
                                        placeholder="Masukan Nama Lengkap" name="nama" value="{{ $pengguna->nama }}">
                                    <label for="floatingInputGrid">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="floatingInputGrid"
                                        placeholder="ex. adi@gmail.com" name="email" value="{{ $pengguna->email }}">
                                    <label for="floatingInputGrid">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputGrid"
                                        placeholder="Masukan Kode Referal" name="kode_afiliasi" value="{{ $pengguna->kode_afiliasi }}">
                                    <label for="floatingInputGrid">Kode Referal</label>
                                </div>
                            </div>
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputGrid"
                                        placeholder="Masukan No Telpon" name="no_telpon" value="{{ $pengguna->no_telpon }}">
                                    <label for="floatingInputGrid">No Telpon</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputGrid"
                                        placeholder="Informasi Bank" name="informasi_bank" value="{{ $pengguna->informasi_bank }}">
                                    <label for="floatingInputGrid">Informasi Bank</label>
                                </div>
                            </div>
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputGrid"
                                        placeholder="Masukan No Rekening" name="no_rekening" value="{{ $pengguna->no_rekening }}">
                                    <label for="floatingInputGrid">No Rekening</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <select class="form-select js-example-basic-single" id="id_provinsi"
                                        aria-label="Floating label select example" name="id_provinsi">
                                        @foreach ($provinsi as $item)
                                            <option value="{{ $item->id_provinsi }}">{{ $item->nama_provinsi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelectGrid">Pilih Provinsi</label>
                                    <script>
                                        $('#id_provinsi').val('{{$pengguna->id_provinsi}}').trigger('change');
                                    </script>
                                </div>
                            </div>
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <select class="form-select js-example-basic-single" id="id_kota"
                                        aria-label="Floating label select example" name="id_kota">
                                        @foreach ($kota as $item)
                                            <option value="{{ $item->id_kota }}">{{ $item->nama_kota }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelectGrid">Pilih Kota</label>
                                    <script>
                                        $('#id_kota').val('{{$pengguna->id_kota}}').trigger('change');
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md mb-4 ">
                                <div class="form-floating float-start">
                                    <button type="submit" class="btn bg-[#9e6925] text-white hover:bg-white hover:!text-[#9e6925] border-[#9e6925]">Simpan</button>
                                </div>
                            </div>
                            <div class="col-md mb-4">

                            </div>
                        </div>
                    </form>
                </div>
                <div id="ubhpassword" class="hidden">
                    <form action="{{ route('frontend.updatePasswordSaya',$id_pengguna) }}" class="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="" class="float-start text-sm mb-1">Password Sekarang</label>
                            <input type="password" class="form-control @error('password_sekarang') is-invalid @enderror" name="password_sekarang"
                                placeholder="" value="{{ old('password_sekarang') }}">
                            @error('password_sekarang')
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="float-start text-sm mb-1">Password Baru</label>
                            <input type="password" class="form-control @error('password_baru') is-invalid @enderror" name="password_baru"
                                placeholder="" value="{{ old('password_baru') }}">
                            @error('password_baru')
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="float-start text-sm mb-1">Password Confirmation</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                placeholder="" value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="py-2">
                            <button type="submit" class="btn bg-[#9e6925] text-white hover:bg-white hover:!text-[#9e6925] border-[#9e6925]">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                function menu(x) {
                    var menu = ['profile', 'ubhpassword'];
                    for (let i = 0; i < menu.length; i++) {
                        $('#'+menu[i]).css('display', 'none');
                        $('.'+menu[i]).removeClass('bg-[#9e6925] rounded-lg text-white');
                    }
                    $('#'+x).css('display', 'block');
                    $('.'+x).addClass('bg-[#9e6925] rounded-lg text-white');
                }
            </script>
        </div>
    @else
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-12" data-aos="zoom-in" data-aos-delay="200">
                <div class="card p-3">
                    <div class="card-body mt-3 text-center">
                        <div>
                            <img src="{{ asset('frontend/baru/images/profile.svg') }}" alt="profile.png"
                                style="width: 35%;">
                        </div>
                        <div class="mt-3">
                            <p>Saldo Afiliasi : Rp. {{ number_format($pengguna->saldo_afiliasi) }}</p>
                        </div>
                        <div class="mt-4">
                            <a href="" class="btn btn-outline-success" style="width: 70%">Ubah Password</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-12" data-aos="zoom-in" data-aos-delay="200">
                <div class="card p-3">
                    <div class="card-body mt-3">
                    <form action="{{route('frontend.updateProfileSaya',$id_pengguna)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-2">
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputGrid"
                                        placeholder="Masukan Nama Lengkap" name="nama" value="{{ $pengguna->nama }}">
                                    <label for="floatingInputGrid">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="floatingInputGrid"
                                        placeholder="ex. adi@gmail.com" name="email" value="{{ $pengguna->email }}">
                                    <label for="floatingInputGrid">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputGrid"
                                        placeholder="Masukan Kode Referal" name="kode_afiliasi" value="{{ $pengguna->kode_afiliasi }}">
                                    <label for="floatingInputGrid">Kode Referal</label>
                                </div>
                            </div>
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputGrid"
                                        placeholder="Masukan No Telpon" name="no_telpon" value="{{ $pengguna->no_telpon }}">
                                    <label for="floatingInputGrid">No Telpon</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputGrid"
                                        placeholder="Informasi Bank" name="informasi_bank" value="{{ $pengguna->informasi_bank }}">
                                    <label for="floatingInputGrid">Informasi Bank</label>
                                </div>
                            </div>
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputGrid"
                                        placeholder="Masukan No Rekening" name="no_rekening" value="{{ $pengguna->no_rekening }}">
                                    <label for="floatingInputGrid">No Rekening</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <select class="form-select js-example-basic-single" id="id_provinsi"
                                        aria-label="Floating label select example" name="id_provinsi">
                                        @foreach ($provinsi as $item)
                                            <option value="{{ $item->id_provinsi }}">{{ $item->nama_provinsi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelectGrid">Pilih Provinsi</label>
                                    <script>
                                        $('#id_provinsi').val('{{$pengguna->id_provinsi}}').trigger('change');
                                    </script>
                                </div>
                            </div>
                            <div class="col-md mb-4">
                                <div class="form-floating">
                                    <select class="form-select js-example-basic-single" id="id_kota"
                                        aria-label="Floating label select example" name="id_kota">
                                        @foreach ($kota as $item)
                                            <option value="{{ $item->id_kota }}">{{ $item->nama_kota }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelectGrid">Pilih Kota</label>
                                    <script>
                                        $('#id_kota').val('{{$pengguna->id_kota}}').trigger('change');
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md mb-4 ">
                                <div class="form-floating float-start">
                                    <button type="submit" class="btn btn-success">Update Profile</button>
                                </div>
                            </div>
                            <div class="col-md mb-4">

                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endif
@endsection
