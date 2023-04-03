<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Pengguna;
use App\Models\Pembelian;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index($cari = null)
    {
        if($cari == null || $cari == "today"){
            $data['type'] = 'today';
            $data['transaksi'] = Pembelian::with('detail.paket', 'pengguna')
            ->whereIn('status_pembelian', ["Berhasil", "Menunggu Pembayaran"])
            ->where('tanggal_pembelian', date('Y-m-d'))
            ->orderBy('id', 'desc')->get();
        }elseif($cari == 'ThisMonth'){
            $data['type'] = "This Month";
            $data['transaksi'] = Pembelian::with('detail.paket', 'pengguna')
            ->whereIn('status_pembelian', ["Berhasil", "Menunggu Pembayaran"])
            ->whereYear('tanggal_pembelian', date('Y'))
            ->whereMonth('tanggal_pembelian', date('m'))
            ->orderBy('id', 'desc')->get();
        }elseif($cari == 'This Year'){
            $data['type'] = "This Year";
            $data['transaksi'] = Pembelian::with('detail.paket', 'pengguna')
            ->whereIn('status_pembelian', ["Berhasil", "Menunggu Pembayaran"])
            ->whereYear('tanggal_pembelian', date('Y'))
            ->orderBy('id', 'desc')->get();
        }
        $data['jumPaket'] = Paket::get()->count();
        $data['jumPengguna'] = Pengguna::get()->count();
        
        $data['total_pendapatan'] = $this->hitungPendapatan();
        return view('backend.home.home', $data);
    }

    private function hitungPendapatan()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $data = DB::table('pembelians')->select(DB::raw('SUM(total_bayar) as total_bayar,SUM(potong_komisi) as total_komisi,tanggal_pembelian'))->whereMonth('tanggal_pembelian', $bulan)->whereYear('tanggal_pembelian', $tahun)->where('status_pembelian', 'Berhasil')->groupBy('tanggal_pembelian')->get();
        return $data;
    }

    public function apiHistoriPendapatanBersih()
    {
        $data = $this->hitungPendapatan();
        return response()->json($data);
    }
}
