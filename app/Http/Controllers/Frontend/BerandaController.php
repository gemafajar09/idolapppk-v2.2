<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kota;
use Session;
use App\Models\Paket;
use App\Models\Youtube;
use App\Models\PembelianDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Artikel;
use App\Models\Instagram;
use App\Models\Tag;
use Hash;

class BerandaController extends Controller
{
    public function index()
    {
        $id_pengguna = session('id_pengguna');
        $status = "Berhasil";
        $paket = [];

        $detail = PembelianDetail::with(['paket.fasilitas' => function ($query) {
            $query->where('status', "Aktif");
        }])->where('id_pengguna', $id_pengguna)->where('status_pembelian', $status)->get();
        foreach ($detail as $key => $value) {
            $result = $this->calculatePaket($value->masa_aktif, $value->tanggal_aktifasi);
            if ($result !== false) {
                $value->tanggal_akhir = $this->get_time_ago(strtotime($result));
                $paket[] = $value;
            }
        }
        $data['jumPaket'] = $paket;

        $data['jumlah_paket'] = Paket::count();
        // dd($data['jumlah_paket']);

        $data['paket'] = Paket::with(['fasilitas' => function ($query) {
            $query->where('status', "Aktif");
        }])->where('tipe_paket', 'Umum')->get();
        $data['youtube'] = Youtube::where('lokasi', 'beranda')->first();
        $data['instagram'] = Instagram::get();

        $data['testimoni'] = DB::table('testimonial')->paginate(10);
        if (!session()->has('id_pengguna')) {
            return view('frontend.pages.home', $data);
        } else {
            return view('user.pages.home', $data);
            // return view('frontend.pages.home_login', $data);
        }
    }

    public function artikelTags($id)
    {
        $data['artikel'] = DB::table('artikels')
            ->where('tags', 'like', '%' . $id . ',%')
            ->orWhere('tags', 'like', '%,' . $id . '%')
            ->get();

        $data['tag'] = Tag::where('id', $id)->first();
        $data['tags'] = Tag::orderByDesc('view')->limit(50)->get();
        return view('frontend.pages.artikelTags', $data);
    }

    public function register($referal = null)
    {
        $data['referal'] = $referal;
        $data['provinsi'] = Provinsi::all();
        $data['kota'] = Kota::all();
        return view('frontend.pages.auth.register', $data);
    }
    public function login()
    {
        return view('frontend.pages.auth.login');
    }

    public function artikel()
    {
        $data['artikel'] = DB::table('artikels')->get();
        $data['berita_populer'] = DB::table('artikels')->orderByDesc('view')->limit(4)->get();
        $data['breaking_news'] = DB::table('artikels')->orderByDesc('id')->limit(2)->get();
        $data['tags'] = DB::table('artikels_tags')->limit(15)->orderBy('view','desc')->get();
        $data['rekomendasi'] = DB::table('artikels')->where('tipe', '1')->orderByDesc('id')->limit(4)->get();
        $data['video'] = DB::table('youtubes')->where('lokasi', 'artikel')->orderByDesc('id')->limit(2)->get();
        $data['artikelx'] = DB::table('artikels')->orderBy('id','DESC')->limit(1)->first();
        return view('frontend.pages.artikel', $data);
    }

    public function detailArtikel($slug)
    {
        $data['artikel'] = DB::table('artikels')->where('slug', $slug)->first();

        // update viewer artikel dan tag
        Artikel::where('slug', $slug)->increment('view');

        foreach (json_decode($data['artikel']->tags, true) ?? [] as $tag) {
            Tag::where('id', $tag)->increment('view');
        }
        $data['tags_all'] = Tag::orderByDesc('view')->limit(50)->get();
        $data['artikels_tags'] = Tag::get();
        $data['berita_populer'] = DB::table('artikels')->orderByDesc('view')->limit(4)->get();
        $data['artikelseluruh'] = DB::table('artikels')->where('tipe', '1')->orderByDesc('created_at')->limit(4)->get();
        return view('frontend.pages.detail_artikel', $data);
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
    public function apiHistoriBonus(Request $r){
        $bulan = date('m');
        $tahun = date('Y');
        $data = DB::table('histori_bonuses')->select(DB::raw('SUM(bonus_afiliasi) as jumlah,tanggal_bonus'))->whereMonth('tanggal_bonus',$bulan)->whereYear('tanggal_bonus',$tahun)->where('id_pengguna',$r->id_pengguna)->groupBy('tanggal_bonus')->get();
        return response()->json($data);
    }

    public function resetPassword(Request $r){
        $email = $r->email;
        $cek = DB::table('penggunas')
                ->where('email',$email)
                ->first();
                // dd($cek);
                $id = encrypt($cek->id);
        $datamail = [
            'nama' => $cek->nama,
            'pesan' => 'Tombol Diatas Merupakan Link Untuk Mereset Password anda, Jika Anda Tidak Meminta Reset Password Silahkan Abaikan Email Ini',
            'dari' => 'Tim Pengembang Idola PPPK',
            'url' => url('password-reset/'.$id),
            'pengembang' => 'Ikhlas Zul Amal',
        ];

        Mail::to($cek->email)->send(new SendMail($datamail));


        return redirect('/');
    }

    public function halamanReset($id){
        $id_pengguna = decrypt($id);
        // dd($id_pengguna);
        return view('frontend.pages.auth.reset',compact('id_pengguna'));
    }

    public function updatePassword(Request $r,$id){
        if ($r->password == $r->password1) {
            $pass = Hash::make($r->password);
            DB::table('penggunas')
            ->where('id',$id)
            ->update([
                'password' => $pass
            ]);
            return redirect('/');
        }else {
            return back()
            ->with('pesan','Password Tidak Sama');
        }
    }
}
