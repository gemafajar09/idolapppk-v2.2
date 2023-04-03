<?php

    namespace App\Services\Midtrans;

    use Midtrans\Snap;
    use App\models\PembelianDetail;
    use App\models\Pengguna;
    use Illuminate\Support\Facades\DB;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct($order)
    {
        parent::__construct();
        $this->order = $order;
    }

    public function getSnapToken()
    {
        $data = DB::table('pembelian_details')->where('kode_pembelian', $this->order->kode_pembelian)->join('pakets', 'pakets.id', 'pembelian_details.id_paket')->select('pembelian_details.*', 'pembelian_details.id as id_detail', 'pakets.*')->get();
        $user = DB::table('penggunas')->where('id', $this->order->id_pengguna)->first();
        
        $pesanan = [];
        foreach ($data as $a) {
            $pesanan[] = array(
                'id' => $a->id_detail,
                'price' => $a->harga,
                'quantity' => 1,
                'name' => $a->nama_paket,
            );
        }
        
        $tambahanbiaya = array(
                'id' => 0,
                'price' => 4000,
                'quantity' => 1,
                'name' => 'Biaya Admin',
            );
        array_push($pesanan, $tambahanbiaya);
        $params = [
            'transaction_details' => [
                'order_id' => $this->order->kode_pembelian,
                'gross_amount' => $this->order->total_bayar,
            ],
            'item_details' => $pesanan,

            'customer_details' => [
                'first_name' => $user->nama,
                'email' => $user->email,
                'phone' => $user->no_telpon,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);
        return $snapToken;
    }
}
