<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;
use Illuminate\Support\Facades\DB;

class PaketController extends Controller
{
    public function paketKategori()
    {
        $data['paket'] = DB::table('kategori_pakets')->select('pakets.*','kategori_pakets.*', 'pakets.id as id_pakets')->join('pakets','pakets.id_kategori_paket','kategori_pakets.id')->get();

        return view('user.pages.paket.kategori', $data);
    }

    public function paketKategoriDetail($id, $type)
    {
        $data['kategori_paket'] = DB::table('kategori_pakets')->where('id', $id)->first();
        // $data['paket'] = Paket::with('fasilitas')->where('id_kategori_paket', $id)->get();
        $data['paket'] = DB::table('pakets')->select('pakets.*','kategori_pakets.*', 'pakets.id as id_pakets')->join('kategori_pakets','pakets.id_kategori_paket','kategori_pakets.id')->where('pakets.id_kategori_paket',$id)->first();
        $data['kategori_kelas'] = $type;
        return view('user.pages.paket.index', $data);
    }

    // public function paketAll()
    // {
    //     $data['paket'] = Paket::with('fasilitas')->get();
    //     return view('user.pages.paket.index', $data);
    // }
    public function paketDetail($slug)
    {
        $data['paket'] = Paket::where('slug', $slug)->first();
        return view('frontend.pages.paket.detail', $data);
    }
}
