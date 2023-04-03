<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriMateri;
use App\Helper\HashHelper;
class KategoriMateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kategori'] = KategoriMateri::get();
        return view('backend.kategori-materi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.kategori-materi.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama_kategori = $request->nama_kategori;
        $kode_kategori = $request->kode_kategori;
        $insert = KategoriMateri::insert([
            "nama_kategori" => $nama_kategori,
            "kode_kategori" => $kode_kategori
        ]);
        if ($insert) {
            return redirect()->route('kategori-materi.index')->with('success', 'Berhasil Menambahkan Kategori materi');
        } else {
            return redirect()->route('kategori-materi.create')->with('error', 'Gagal Menambahkan Kategori materi');
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
        $data['kategori'] = KategoriMateri::find($id);
        return view('backend.kategori-materi.edit', $data);
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
        $kategori = KategoriMateri::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->kode_kategori = $request->kode_kategori;
        $kategori->save();
        if($kategori){
            return redirect()->route('kategori-materi.index')->with('success', 'Berhasil Mengupdate');
        }else{
            return redirect()->route('kategori-materi.edit',$id_kat)->with('error', 'Gagal Menambahkan');
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
        $delete = KategoriMateri::where('id',$id)->delete();
        if($delete){
            return redirect()->route('kategori-materi.index')->with('success', 'Berhasil Menghapus');
        }else{
            return redirect()->route('kategori-materi.index')->with('error', 'Gagal Menambahkan');
        }
    }
}
