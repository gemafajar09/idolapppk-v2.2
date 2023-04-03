@extends('frontend.layout.index')

@section('content')
    @include('frontend.components.breadcumb',['title'=>"Halaman Profile",'subtitle'=>"Profile"])
    <!-- ======= Pricing Section ======= -->
    <section id="detail" class="histori-pembelian">

        <div class="container" data-aos="fade-up">

            <div class="row gy-4" data-aos="fade-left">
                <div class="col-lg-12 col-md-12 col-12 text-left" data-aos="zoom-in" data-aos-delay="200">
                    <div class="box">
                        <h3 style="color: #65c600;font-size:1.7em;"><i class="ri-history-fill"></i> Histori Pembelian</h3>
                        @if (count($pembelian) > 0)
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Detail</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembelian as $key => $item)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td>{{ date('d-m-Y', strtotime($item->tanggal_pembelian)) }}</td>
                                                <td>{{ $item->kode_pembelian }}</td>
                                                <td>Rp.{{ number_format($item->total_bayar) }}</td>
                                                <td>
                                                    <ol>
                                                        @foreach ($item->detail as $detail)
                                                            <li>{{ $detail->paket->nama_paket }}</li>
                                                        @endforeach
                                                    </ol>
                                                </td>
                                                <td>{{ $item->status_pembelian }}</td>
                                                @if ($item->status_pembelian == 'Menunggu Pembayaran')
                                                @php
                                                $id_transaksi = App\Helper\HashHelper::encryptData($item->id);
                                            @endphp
                                                    <td><button class="btn btn-danger"
                                                            onclick="openModal('{{ $id_transaksi }}','{{ $item->kode_pembelian }}')">Batal</button></td>
                                                @endif
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="row pb-3">
                                <div class="col-lg-12 text-center">
                                    <img src="{{ asset('frontend/baru/images/no-data.svg') }}" alt=""
                                        class="mb-3">
                                    <h3>Tidak ada Histori</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Untuk Batal Pembelian ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Kode : <span id="kode_pembelian"></span></p>
                    <form action="{{route('frontend.checkout.batal')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id_transaksi" id="id_transaksi">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Proses</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Pricing Section -->
@endsection

@push('addon-script')
    <script>
        function openModal(id,kode_pembelian) {
            $('#id_transaksi').val(id)
            $('#kode_pembelian').html(kode_pembelian)
            $('#exampleModal').modal('show')
        }
    </script>
@endpush
