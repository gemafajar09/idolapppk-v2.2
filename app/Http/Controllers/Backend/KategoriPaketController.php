<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriPaket;
use App\Helper\HashHelper;

class KategoriPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kategori'] = KategoriPaket::get();
        return view('backend.kategori-paket.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.kategori-paket.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama = $request->nama;
        $type = $request->type;

        $request->validate([
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file = $request->file('banner');
        $fileExtension = $file->getClientOriginalExtension();
        $namebanner = "banner/image-" . date('Ymdhis') . ".$fileExtension";
        $file->move('banner/', $namebanner);

        $insert = KategoriPaket::insert([
            "nama" => $nama,
            "type" => $type,
            "banner" => $namebanner
        ]);
        if ($insert) {
            return redirect()->route('kategori-paket.index')->with('success', 'Berhasil Menambahkan Kategori Paket');
        } else {
            return redirect()->route('kategori-paket.create')->with('error', 'Gagal Menambahkan Kategori Paket');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = HashHelper::decryptData($id);
        if (!$id) {
            return redirect()->back()->with('error', 'Gagal Edit');
        }
        $data['kategori'] = KategoriPaket::find($id);
        return view('backend.kategori-paket.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kat)
    {
        $id = HashHelper::decryptData($id_kat);
        if (!$id) {
            return redirect()->back()->with('error', 'Gagal Edit');
        }
        $kategori = KategoriPaket::find($id);
        $kategori->nama = $request->nama;
        $kategori->type = $request->type;


        $file = $request->file('banner');
        if ($file) {
            $fileExtension = $file->getClientOriginalExtension();
            $namebanner = "banner/image-" . date('Ymdhis') . ".$fileExtension";
            $file->move('banner/', $namebanner);
            $kategori->banner = $namebanner;
        }

        $kategori->save();


        if ($kategori) {
            return redirect()->route('kategori-paket.index')->with('success', 'Berhasil Mengupdate');
        } else {
            return redirect()->route('kategori-paket.edit', $id_kat)->with('error', 'Gagal Menambahkan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = HashHelper::decryptData($id);
        if (!$id) {
            return redirect()->back()->with('error', 'Gagal Hapus');
        }
        $delete = KategoriPaket::where('id', $id)->delete();
        if ($delete) {
            return redirect()->route('kategori-paket.index')->with('success', 'Berhasil Menghapus');
        } else {
            return redirect()->route('kategori-paket.index')->with('error', 'Gagal Menambahkan');
        }
    }
}
