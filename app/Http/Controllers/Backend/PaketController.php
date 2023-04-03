<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\KategoriPaket;
use App\Models\Materi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PaketController extends Controller
{
    public function index()
    {
        $data['data'] = Paket::with('kategori')->get();
        $data['materi'] = Materi::all();
        $data['kategori'] = KategoriPaket::get();
        return view('backend.paket.index', $data);
    }

    public function simpan(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id_kategori_paket' => '',
            'tipe_paket'=>'required',
            'nama_paket' => 'required|string',
            'harga_paket' => 'required',
            'harga_coret' => 'required|nullable',
            'masa_aktif' => 'required|nullable',
            'deskripsi_paket' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }

        $simpan = Paket::insert([
            'id_kategori_paket'=>$r->id_kategori_paket,
            'tipe_paket'=> $r->tipe_paket,
            'nama_paket' => $r->nama_paket,
            'harga_paket' => $r->harga_paket,
            'harga_coret' => $r->harga_coret,
            'masa_aktif' => $r->masa_aktif,
            'deskripsi_paket' => $r->deskripsi_paket,
            'slug' => Str::slug($r->nama_paket, '-')
        ]);
        if ($simpan == TRUE) {
            return back()->with("success", "Berhasil Disimpan");
        } else {
            return back()->with("error", "Error");
        }
    }

    public function getdata(Request $r)
    {
        $data = Paket::where("id", $r->id)->first();
        return response()->json($data);
    }

    public function update(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id_kategori_paket_e' => '',
            'tipe_paket_e'=>'required',
            'nama_paket_e' => 'required|string',
            'harga_paket_e' => 'required',
            'harga_coret_e' => 'required|nullable',
            'masa_aktif_e' => 'required|nullable',
            'deskripsi_paket_e' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }

        $update = Paket::where('id', $r->id_e)->update([
            'id_kategori_paket' => $r->id_kategori_paket_e,
            'tipe_paket' => $r->tipe_paket_e,
            'nama_paket' => $r->nama_paket_e,
            'harga_paket' => $r->harga_paket_e,
            'harga_coret' => $r->harga_coret_e,
            'masa_aktif' => $r->masa_aktif_e,
            'deskripsi_paket' => $r->deskripsi_paket_e,
            'slug' => Str::slug($r->nama_paket_e, '-')
        ]);

        if ($update == TRUE) {
            return back()->with("success", "Berhasil Diupdate");
        } else {
            return back()->with("error", "Error");
        }
    }

    public function hapus($id)
    {
        $hapus = Paket::where('id', $id)->delete();
        if ($hapus == TRUE) {
            return back()->with(["success" => "Berhasil Dihapus"]);
        } else {
            return back()->with(["error" => "Error"]);
        }
    }
}
