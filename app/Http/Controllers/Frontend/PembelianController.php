<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PembelianTmp;
use App\Models\Paket;
use App\Models\Pembelian;
use App\Http\Requests\KeranjangRequest;
use App\Http\Requests\CheckoutRequest;
use App\Helper\HashHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Pengguna;
use App\Models\PersenAfiliasi;
use App\Models\PembelianDetail;
use Illuminate\Support\Facades\DB;
use App\Services\Midtrans\CreateSnapTokenService;

class PembelianController extends Controller
{

    public function show(PembelianDetail $order)
    {
        $snapToken = $order->snap_token;
        if (empty($snapToken)) {

            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();

            $order->snap_token = $snapToken;
            $order->save();
        }

        return view('orders.show', compact('order', 'snapToken'));
    }

    public function viewKeranjang()
    {
        $id_pengguna = session('id_pengguna');
        $data['tmp'] = PembelianTmp::with('paket.fasilitas')->where('id_pengguna', $id_pengguna)->first();
        // return view('frontend.pages.transaksi.keranjang', $data);
        if($data['tmp']){
            $data['materi'] = DB::table("materis")->where('id_paket',$data['tmp']->id_paket)->get();
        }

        return view('user.pages.transaksi.keranjang', $data);
    }

    public function prosesKeranjang(KeranjangRequest $request)
    {
        $id_pengguna = session('id_pengguna');
        $validatedData = $request->validated();
        // $data['kategori_paket'] = $request->type;
        $id_paket = HashHelper::decryptData($validatedData['id_paket']);
        if (!$id_paket) {
            return back()->with('error', 'Invalid Kode Paket');
        }

        // cek keranjnag pembelian
        $cekPembelian = DB::table('pembelian_details')->where('id_pengguna', $id_pengguna)->where('id_paket', $id_paket)->where('status_pembelian', 'Berhasil')->first();
        // cek keranjang
        $cekKeranjang = DB::table('pembelian_tmps')->where('id_pengguna', $id_pengguna)->where('id_paket', $id_paket)->first();

        if ($cekPembelian == true) {
            return back()->with('error', 'Paket sudah ada dalam list anda.');
        }

        try {
            $paket = Paket::findOrFail($id_paket);
        } catch (ModelNotFoundException $error) {
            return back()->with('error', 'Paket Tidak Ditemukan');
        }
        $dataTmp = [
            "id_pengguna" => $id_pengguna,
            "id_paket" => $id_paket,
            "harga" => $paket->harga_paket,
            "harga_coret" => $paket->harga_coret,
            "masa_aktif" => $paket->masa_aktif
        ];
        DB::beginTransaction();
        try {
            PembelianTmp::where('id_pengguna', $id_pengguna)->delete();
            $result = PembelianTmp::create($dataTmp);
            DB::commit();
            return redirect()->route('frontend.keranjang')->with('success', 'Item Berhasil Dimasukan Kedalam Keranjang');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Gagal Menambahkan Item Kekeranjang');
        }
    }

    public function deleteKeranjang(Request $r)
    {
        $id_tmp = $r->id_tmp;
        if (empty($id_tmp)) {
            return redirect()->route('frontend.keranjang')->with('error', 'Gagal Hapus Item');
        }
        $id_tmp = HashHelper::decryptData($id_tmp);
        if (!$id_tmp) {
            return back()->with('error', 'Gagal Hapus Item');
        }
        // dd($id_tmp);
        try {
            $delete = PembelianTmp::findOrFail($id_tmp)->delete();
        } catch (ModelNotFoundException $error) {
            return back()->with('error', 'Gagal Hapus Item');
        }
        if (!empty($delete)) {
            return redirect()->route('frontend.keranjang')->with('success', 'Item Berhasil Dihapus');
        } else {
            return back()->with('error', 'Gagal Hapus Item');
        }
    }

    public function hapusKeranjang(Request $r)
    {
        $kode_pembelian = $r->kode_pembelian;
        // dd($kode_pembelian);
        $hapus = DB::table('pembelians')->where('kode_pembelian', $kode_pembelian)->delete();
        if ($hapus == true) {
            DB::table('pembelian_details')->where('kode_pembelian', $kode_pembelian)->delete();

            return back()->with('success', 'Berhasil menghapus data');
        } else {
            return back()->with('error', 'Gagal menghapus data');
        }
    }

    public function setKodeAfiliasi(Request $r)
    {
        $id_pengguna = session('id_pengguna');
        $afiliasi_digunakan = $r->kode_afiliasi;
        if (empty($afiliasi_digunakan)) {
            return back()->with('error', 'Gagal Penggunaan Kode Referal');
        }
        // cari verifikasi kode_referal
        try {
            $pengguna = Pengguna::findOrFail($id_pengguna);
        } catch (ModelNotFoundException $error) {
            return back()->with('error', 'Gagal Penggunaan Kode Referal');
        }
        $kode_pengguna_sesssion = $pengguna->kode_afiliasi;
        $afiliasi = Pengguna::where('kode_afiliasi', $afiliasi_digunakan)->whereNotIn('kode_afiliasi', [$kode_pengguna_sesssion])->first();
        if (empty($afiliasi)) {
            session()->forget('kode_afiliasi');
            session()->forget('besar_afiliasi');
            return back()->with('error', 'Gagal Penggunaan Kode Referal');
        } else {
            $persenAfiliasi = PersenAfiliasi::first()->persen ?? 0;
            session()->put('kode_afiliasi', $afiliasi->kode_afiliasi);
            session()->put('besar_afiliasi', $persenAfiliasi);
            return back()->with('success', 'Success Penggunaan Kode Referal');
        }
    }

    public function checkout()
    {
        $id_pengguna = session('id_pengguna');
        $jumlahTmp = PembelianTmp::where('id_pengguna', $id_pengguna)->count();
        if ($jumlahTmp <= 0) {
            return back()->with('error', 'Item Keranjang Tidak Ada');
        }
        $data['tmp'] = PembelianTmp::with('paket')->where('id_pengguna', $id_pengguna)->get();
        return view('frontend.pages.transaksi.checkout', $data);
    }

    public function removeKodeAfiliasi()
    {
        session()->forget('kode_afiliasi');
        session()->forget('besar_afiliasi');
        return back()->with('success', 'Berhasil Remove kode Referal');
    }

    public function prosesCheckout(Pembelian $pembelian, Request $r)
    {
        $id_pengguna = session('id_pengguna');
        $kode_pembelian = "INV-" . date('dmyhis') . uniqid();
        $tanggal_pembelian = date('Y-m-d');
        $status = "Menunggu Pembayaran";
        $tmp = PembelianTmp::where('id_pengguna', $id_pengguna)->get();
        if (count($tmp) <= 0) {
            return back()->with('error', 'Item Keranjang Tidak Ada');
        }
        $total = 0;
        $potong_harga = 0;
        foreach ($tmp as $value) {
            if (session()->has('kode_afiliasi')) {
                $total += $value->harga;
                $harga = $value->harga;
                $potong_harga = $value->harga_coret - $value->harga;
            } else {
                $total += $value->harga_coret;
                $harga = $value->harga_coret;
            }
            $detail = PembelianDetail::create(["kode_pembelian" => $kode_pembelian, "id_pengguna" => $id_pengguna, "id_paket" => $value->id_paket, "harga" => $harga, "masa_aktif" => $value->masa_aktif, "status_pembelian" => $status, "tanggal_pembelian" => $tanggal_pembelian]);
        }
        $total_bayar = $total;
        $tmpTotal = substr((int)$total_bayar, 0, -3);
        // $total_unik = $tmpTotal . rand(101, 999);
        $dataTransaksi = [
            "kode_pembelian" => $kode_pembelian,
            "kode_referal" => session('kode_afiliasi'),
            "id_pengguna" => $id_pengguna,
            "total" => $total,
            "potong_harga" => $potong_harga,
            "total_bayar" => $total_bayar,
            "bank" => "bri",
            "status_pembelian" => $status,
            "tanggal_pembelian" => $tanggal_pembelian
        ];
        DB::beginTransaction();
        try {
            $insertPembelian = Pembelian::insertGetId($dataTransaksi);
            $deleteTmp = PembelianTmp::where('id_pengguna', $id_pengguna)->delete();
            session()->forget('kode_afiliasi');
            session()->forget('besar_afiliasi');
            DB::commit();
            $kode_pembelian_hash = HashHelper::encryptData($kode_pembelian);
            $pembeli = DB::table('pembelians')->where('id', $insertPembelian)->first();
            $snapToken = $pembeli->snap_token;
 
            if ($snapToken == null) {
                $midtrans = new CreateSnapTokenService($pembeli);
                $snapToken = $midtrans->getSnapToken();

                $pembelian->snap_token = $snapToken;
                $pembelian->save();
            }

            // return response()->json(['status' => 200, "snap" => $snapToken]);
            return redirect()->route('frontend.billing', [$kode_pembelian_hash,$snapToken])->with('success', 'Terimakasih Sudah Berlangganan, Segera Lakukan Pembayaran Untuk Mengaktifkan Pembelian');
        } catch (\Exception $th) {
            DB::rollBack();
            // return response()->json(['status' => 500]); 
            dd($th);
            // return back()->with('error', 'Checkout Gagal Dilakukan, Harap Mencoba Lagi Nanti');
        }
    }

    public function billing($kode_pembelian, $tkn)
    {
        $kode_pembelian = HashHelper::decryptData($kode_pembelian);
        if (!$kode_pembelian) {
            return redirect()->route('frontend.paketKategori')->with('error', 'Kode Pembelian Invalid');
        }
        $pembelian = Pembelian::where('kode_pembelian', $kode_pembelian)->first();
        if (empty($pembelian)) {
            return redirect()->route('frontend.paketKategori')->with('error', 'Kode Pembelian Invalid');
        }
        $data['pembelian'] = $pembelian;
        $data['snapToken'] = $tkn;
        return view('user.pages.transaksi.billing', $data);
    }

    public function historiPembelian($id_pengguna)
    {
       $id_pengguna = HashHelper::decryptData($id_pengguna);
        if (!$id_pengguna) {
            return back()->with('error', 'Gagal Load Data');
        }
        $data['pembelian'] = Pembelian::with('detail.paket')->where('id_pengguna', $id_pengguna)->orderBy('id', 'desc')->get();

        return view('user.pages.profile.histori-pembelian', $data);
    }

    public function cekPembayaran(Pembelian $pembelian, $id)
    {
        $pembeli = DB::table('pembelians')->where('id', $id)->first();
        $snapToken = $pembeli->snap_token;
        if (empty($snapToken)) {

            $midtrans = new CreateSnapTokenService($pembeli);
            $snapToken = $midtrans->getSnapToken();

            $pembelian->snap_token = $snapToken;
            $pembelian->save();
        }
        return response()->json(["snap" => $snapToken]);
    }

    public function batalCheckout(Request $r)
    {
        $id_transaksi = HashHelper::decryptData($r->id_transaksi);
        if (!$id_transaksi) {
            return redirect()->back()->with('error', 'Kode Pembelian Invalid');
        }
        try {
            $transaksi = Pembelian::findOrFail($id_transaksi);
        } catch (ModelNotFoundException $error) {
            return back()->with('error', 'Tidak Dapat Membatalkan Transaksi');
        }
        DB::beginTransaction();
        try {
            $status_batal = "Batal";
            $transaksi->status_pembelian = $status_batal;
            PembelianDetail::where('kode_pembelian', $transaksi->kode_pembelian)->update(["status_pembelian" => $status_batal]);
            $transaksi->save();
            DB::commit();
            return back()->with('success', 'Transaksi Dibatalkan');
        } catch (\Exception $th) {
            DB::rollBack();
            return back()->with('error', 'Tidak Dapat Membatalkan Transaksi');
        }
    }
}
