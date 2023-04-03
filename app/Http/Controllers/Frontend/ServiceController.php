<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PembelianDetail;
use App\Models\Pembelian;
use App\Models\Paket;
use App\Helper\HashHelper;
use App\Models\Materi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ServiceController extends Controller
{
    public function paketSaya()
    {
        $id_pengguna = session('id_pengguna');
        $status = "Berhasil";
        $paket = [];

        $detail = PembelianDetail::with([
            'paket.kategori',
            'paket.fasilitas' => function ($query) {
                $query->where('status', "Aktif");
            }
        ])->where('id_pengguna', $id_pengguna)->where('status_pembelian', $status)->whereDate('tanggal_aktifasi','>',Carbon::now()->subMonths(6))->get();
        
        foreach ($detail as $key => $value) {
            $result = $this->calculatePaket($value->masa_aktif, $value->tanggal_aktifasi);
            if ($result !== false) {
                $value->tanggal_akhir = $this->get_time_ago(strtotime($result));
                $paket[] = $value;
            }
        }

        $data['paket'] = $paket;
        return view('user.pages.service.paket-saya', $data);
    }

    public function materiPaketSaya($data, $slug, $id_materi = null)
    {
        $result = HashHelper::decryptArray($data);

        if (!$result) {
            return back()->with('error', 'Invalid Kode');
        }
        $id_paket = $result['id_paket'];
        $id_detail = $result['id_detail'];
        // cek kadaluwarsa paket
        try {
            $detail = PembelianDetail::findOrFail($id_detail);
        } catch (ModelNotFoundException $error) {
            return back()->with('error', 'Materi Tidak Ditemukan');
        }
        $result = $this->calculatePaket($detail->masa_aktif, $detail->tanggal_aktifasi);
        if ($result == false) {
            return back()->with('error', 'Materi Tidak Ditemukan');
        }

        if (empty($id_materi)) {
            $materi = Materi::where('id_paket', $id_paket)->where('type', 2)->where('slug', $slug)->first();
        } else {
            $parse['materi_tampil'] = Materi::where('id_paket', $id_paket)->where('slug', $slug)->where('id', $id_materi)->where('type', 2)->first();
        }


        // video
        $list_materi = [];
        $materi = Materi::where('id_paket', $id_paket)->where('type', 2)->where('slug', $slug)->groupBy('slug')->get();
        foreach ($materi as $key => $value) {
            $detail = Materi::where('id_paket', $id_paket)->where('type', 2)->where('slug', $value->slug)->get();
            $list_materi[$key] = [
                "nama_materi" => $value->materi,
                "data" => $detail
            ];
        }
        $parse['list_materi'] = $list_materi;


        $parse['parameter_paket'] = $data;
        $parse['tipe_materi'] = "2";
        $parse['kategori_materi'] = DB::table('kategori_materis')->get();
        return view('user.pages.service.paket-materi', $parse);
    }

    public function materiPaketSayaPdf($data, $slug, $id_materi = null)
    {
        $result = HashHelper::decryptArray($data);
        if (!$result) {
            return back()->with('error', 'Invalid Kode');
        }
        $id_paket = $result['id_paket'];

        $id_detail = $result['id_detail'];
        // cek kadaluwarsa paket
        try {
            $detail = PembelianDetail::findOrFail($id_detail);
        } catch (ModelNotFoundException $error) {
            return back()->with('error', 'Materi Tidak Ditemukan');
        }
        $result = $this->calculatePaket($detail->masa_aktif, $detail->tanggal_aktifasi);
        if ($result == false) {
            return back()->with('error', 'Materi Tidak Ditemukan');
        }
        // video
        if (empty($id_materi)) {
            $materi = Materi::where('id_paket', $id_paket)->where('type', 1)->where('slug', $slug)->first();
        } else {
            $parse['materi_tampil'] = Materi::where('id_paket', $id_paket)->where('slug', $slug)->where('id', $id_materi)->where('type', 1)->first();

            // dd($parse['materi_tampil']);
        }

        $list_materi = [];
        $materi = Materi::where('id_paket', $id_paket)->where('type', 1)->where('slug', $slug)->groupBy('slug')->get();
        foreach ($materi as $key => $value) {
            $detail = Materi::where('id_paket', $id_paket)->where('type', 1)->where('slug', $value->slug)->get();
            $list_materi[$key] = [
                "nama_materi" => $value->materi,
                "data" => $detail
            ];
        }
        $parse['list_materi'] = $list_materi;
        $parse['parameter_paket'] = $data;
        $parse['tipe_materi'] = "1";
        return view('user.pages.service.paket-materi', $parse);
    }

    public function materiPaketSayaDetail($id_paket, $id_materi = null, $id_kategori = null)
    {

        $result = HashHelper::decryptArray($id_paket);
        if (!$result) {
            return back()->with('error', 'Invalid Kode');
        }

        $id_paket = $result['id_paket'];
        $id_detail = $result['id_detail'];

        // video
        $parse['kategori_materi'] = DB::table('materis')->join('kategori_materis', 'materis.id_kategori_materi', '=', 'kategori_materis.id')->select('materis.id_kategori_materi', 'materis.id_paket', 'kategori_materis.kode_kategori', 'kategori_materis.nama_kategori')->where('id_paket', $id_paket)->where('type', 2)->groupBy('materis.id_kategori_materi')->get();

        $list_materi = [];

        $parse['list_materi'] = $list_materi;
        $parse['tipe_materi'] = "2";

        return view('user.pages.service.detail-paket-materi', $parse);
    }

    public function materiPaketSayaPdfDetail($id_paket, $id_materi = null, $id_kategori = null)
    {

        $result = HashHelper::decryptArray($id_paket);
        if (!$result) {
            return back()->with('error', 'Invalid Kode');
        }

        $id_paket = $result['id_paket'];
        $id_detail = $result['id_detail'];

        // video
        $parse['kategori_materi'] = DB::table('materis')->join('kategori_materis', 'materis.id_kategori_materi', '=', 'kategori_materis.id')->select('materis.id_kategori_materi', 'materis.id_paket', 'kategori_materis.kode_kategori', 'kategori_materis.nama_kategori')->where('id_paket', $id_paket)->where('type', 1)->groupBy('materis.id_kategori_materi')->get();

        $list_materi = [];

        $parse['list_materi'] = $list_materi;
        $parse['tipe_materi'] = "1";

        return view('user.pages.service.detail-paket-materi', $parse);
    }

    private function get_time_ago($time)
    {
        $time_difference =  $time - time();

        if ($time_difference < 1) {
            return 'less than 1 second ago';
        }
        $condition = array(
            12 * 30 * 24 * 60 * 60 =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        );

        foreach ($condition as $secs => $str) {
            $d = $time_difference / $secs;

            if ($d >= 1) {
                $t = round($d);
                return $t . ' ' . $str . ($t > 1 ? 's' : '') . ' ago';
            }
        }
    }

    private function calculatePaket($masa_aktif, $tanggal_aktifasi)
    {
        $sisa_waktu = strtotime('+' . $masa_aktif . 'months', strtotime($tanggal_aktifasi));
        $tanggal_akhir = date('Y-m-d', $sisa_waktu);
        $tanggal_sekarang = date('Y-m-d');
        if ($tanggal_sekarang < $tanggal_akhir) {
            return $tanggal_akhir;
        } else {
            return false;
        }
    }

    public function hasilTryOut()
    {
        $id_pengguna = session('id_pengguna');

        $data['hasilujians'] = DB::table('hasilujians')->where('id_user', $id_pengguna)->join('pakets', 'pakets.id', 'hasilujians.id_paket')->join('fasilitas', 'fasilitas.id', 'hasilujians.id_fasilitas')->orderBy('hasilujians.id', 'DESC')->get();

        $paketAll = Paket::all();

        $data['paket'] = $paketAll;

        $pecahSemua = [];

        foreach ($paketAll as $paket) {
            $pecahSemua[] = DB::table('hasilujians')->where('hasilujians.id_paket', $paket->id)
                ->join('penggunas', 'penggunas.id', 'hasilujians.id_user')
                ->join('pakets', 'pakets.id', 'hasilujians.id_paket')
                ->join('fasilitas', 'fasilitas.id', 'hasilujians.id_fasilitas')
                // ->select(DB::raw('(hasilujians.bobot_a + hasilujians.bobot_b + hasilujians.bobot_c + hasilujians.bobot_d) as skor'), 'hasilujians.bobot_a', 'hasilujians.bobot_b', 'hasilujians.bobot_c', 'hasilujians.bobot_d', 'penggunas.nama')->orderBy('skor', 'DESC')
                ->select(DB::raw('(hasilujians.bobot_b + hasilujians.bobot_c + hasilujians.bobot_d) as skor'), 'hasilujians.bobot_a', 'hasilujians.bobot_b', 'hasilujians.bobot_c', 'hasilujians.bobot_d', 'penggunas.nama')->orderBy('skor', 'DESC')
                ->get();
        }

        $data['ranking'] = $pecahSemua;

        return view('user.pages.service.hasil-try-out', $data);
    }
}
