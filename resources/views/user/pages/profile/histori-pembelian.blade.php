@extends('user.layout.app')
@section('title', 'IdolaPPPK - Histori Pembelian')

@section('content')
<div class="pagetitle">
    <h1>Histori Pembelian</h1>
    
</div>
<section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
          <div class="col-md-12">
              <div class="row">
                  <div class="card">
                      <div class="card-body p-3">
                        <table class="table datatable">
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
                                        $kode_pembelians = App\Helper\HashHelper::encryptData($item->kode_pembelian);
                                    @endphp
                                        <td>
                                            <button style="width:100%;" type="button" onclick="bayars('{{$item->id}}')" class="btn btn-info">Bayar</button>
                                            <br>
                                            <button style="width:100%;" class="btn btn-danger"
                                                onclick="openModal('{{ $item->kode_pembelian }}')">Batal</button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                          </table>
                      </div>
                  </div>
              </div>
            </div>
            </div>
        </div>
    </div>
</section>

    <div class="modal fade" id="delete_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus data</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="post" action="{{url('hapus-keranjang')}}" id="delete_form">
          @csrf
            <div class="modal-body">
                Yakin akan dihapus ?
                <input type="hidden" name="kode_pembelian" id="kode_pembelian" />
                
            </div>
            <div class="modal-footer">
                <input type="submit" name="delete" id="delete" value="Delete" class="btn btn-success" /> 
                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>          
            </div>
        </form>  
        </div>
      </div>
    </div>
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    function bayars(id) {
        $.ajax({
            url: "{{url('api/cekPembayaran')}}/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(res){
                snap.pay(res.snap, {
                    // Optional
                    onSuccess: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result)
                    },
                    // Optional
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result)
                    },
                    // Optional
                    onError: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result)
                    }
                });
            }
        })

    }

    function openModal(kode_pembelian){
        $('#delete_modal').modal('show')
        $('#kode_pembelian').val(kode_pembelian)
    }
</script>
@endsection