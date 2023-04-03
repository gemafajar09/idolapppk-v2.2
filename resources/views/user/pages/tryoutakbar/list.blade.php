@extends('user.layout.app')
@section('title', 'IdolaPPPK - Try Out')

@section('content')
    <div class="pagetitle container">
        <h1>Tryout Akbar</h1>
    </div>
    <section class="section dashboard container py-2">
        <div class="row">
            @foreach ($data as $i => $item)
                <div class="col-md-6 col-lg-4">
                    <div class="bg-white shadow-lg my-3 rounded-lg">
                        <div class="p-4">
                            <h4 class="font-semibold text-xl"> {{$item->nama_tryout}} {{ $i+1 }} {{App\Helper\HashHelper::bulantahun(date('Y-m'))}}</h4>
                            <div class="flex gap-2">
                                <div>
                                    @php
                                        $totalSoal = DB::table('soals')->where('id_tryout',$item->id_tryout)->count() ?? 0 ;
                                        $ujian = DB::table('soals')->where('id_tryout',$item->id_tryout)->first();
                                    @endphp
                                    <i class='bx bx-file'></i> {{$totalSoal}} Soal
                                </div>
                                <div>
                                    <i class='bx bx-time-five'></i> {{$item->durasi}} Menit
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="flex flex-col gap-2 mt-2 py-2">
                                <div>
                                    <div class="font-semibold">
                                        Tanggal Mulai:
                                    </div>
                                    <div>
                                        {{App\Helper\HashHelper::tanggal_indonesia($item->tgl_mulai)}} {{$item->wkt_mulai}}
                                    </div>
                                </div>
                                <div>
                                    <div class="font-semibold">
                                        Tanggal Selesai:
                                    </div>
                                    <div>
                                        {{App\Helper\HashHelper::tanggal_indonesia($item->tgl_selesai)}} {{$item->wkt_selesai}}
                                    </div>
                                </div>
                            </div>
                            @if(date('Y-m-d') > $item->tgl_mulai && date('Y-m-d') < $item->tgl_selesai)
                                <a target="_blank" <?= $item->tgl_mulai > date('Y-m-d') && $item->tgl_selesai ? '' : 'disabled' ?> href="http://localhost:3000/?id_user={{ session('id_pengguna') }}&id_paket={{ $ujian->id_paket ?? 0 }}&id_fasilitas={{ $ujian->id_fasilitas }}&id_tryout={{ $ujian->id_tryout ?? 0 }}" class="border-[#9d8069] cursor-pointer border-2 w-full py-1 mt-2 flex items-center justify-center gap-2 text-[#9d8069] rounded-md hover:bg-[#9d8069] hover:text-white">
                                    <i class='bx bx-bar-chart text-lg'></i> Mulai Ujian
                                </a>
                            @endif
                                <a type="submit" href="{{ route('frontend.tryout-skor',$item->id_tryout) }}" class="border-[#9d8069] cursor-pointer border-2 w-full py-1 mt-2 flex items-center justify-center gap-2 text-[#9d8069] rounded-md">
                                    <i class='bx bx-bar-chart text-lg'></i> Peringkat
                                </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
