<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Pencairan;
use App\Models\Reportsoal;
class LaporanController extends Controller
{
    public function index(){
       return view('backend.laporan.index'); 
    }
    public function laporanPendapatan(Request $r){
        
        if(empty($r->all())){
            $data['total_pendapatan'] = $this->hitungPendapatan();
        }else{
            $data['total_pendapatan'] = $this->hitungPendapatanTanggal($r->dari,$r->sampai);
        }
        return view('backend.laporan.pendapatan',$data);
    }

    private function hitungPendapatan(){
        $bulan = date('m');
        $tahun = date('Y');
        $data = DB::table('pembelians')->select(DB::raw('SUM(total_bayar) as total_bayar,SUM(potong_komisi) as total_komisi,tanggal_pembelian'))->whereMonth('tanggal_pembelian',$bulan)->whereYear('tanggal_pembelian',$tahun)->where('status_pembelian','Berhasil')->groupBy('tanggal_pembelian')->get();
        return $data;
    }
    private function hitungPendapatanTanggal($dari,$sampai){
        $data = DB::table('pembelians')->select(DB::raw('SUM(total_bayar) as total_bayar,SUM(potong_komisi) as total_komisi,tanggal_pembelian'))->whereBetween('tanggal_pembelian', [$dari,$sampai])->where('status_pembelian','Berhasil')->groupBy('tanggal_pembelian')->get();
        return $data;
    }

    public function laporanPencairan(Request $r){
        
        if(empty($r->all())){
            $data['total_pencairan'] = $this->hitungPencairan();
        }else{
            $data['total_pencairan'] = $this->hitungPencairanTanggal($r->dari,$r->sampai);
        }
        return view('backend.laporan.pencairan',$data);
    }
    private function hitungPencairan(){
        $bulan = date('m');
        $tahun = date('Y');
        $data = Pencairan::with('pengguna')->whereMonth('tanggal_pencairan',$bulan)->whereYear('tanggal_pencairan',$tahun)->where('status_pencairan','Valid')->get();
        return $data;
    }
    private function hitungPencairanTanggal($dari,$sampai){
        $data = Pencairan::with('pengguna')->whereBetween('tanggal_pencairan', [$dari,$sampai])->where('status_pencairan','Valid')->get();
        return $data;
    }

    public function laporanSoal(){
        $data['laporans'] = Reportsoal::with('paket','fasilitas','soal')->orderBy('id','DESC')->get();
        return view('backend.laporan.soal',$data);
    }
}
