<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubKategoriMateri;
use App\Models\KategoriMateri;
use App\Helper\HashHelper;
class SubKategoriMateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sub_kategori'] = SubKategoriMateri::with('kategori')->get();
        return view('backend.subkategori-materi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kategori'] = KategoriMateri::get();
        return view('backend.subkategori-materi.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_kategori_materi = $request->id_kategori_materi;
        $nama_subkategori = $request->nama_subkategori;
        $deskripsi_subkategori = $request->deskripsi_subkategori;
        $insert = SubKategoriMateri::insert([
            "nama_subkategori" => $nama_subkategori,
            "deskripsi_subkategori" => $deskripsi_subkategori,
            "id_kategori_materi" => $id_kategori_materi,
        ]);
        if ($insert) {
            return redirect()->route('subkategori-materi.index')->with('success', 'Berhasil Menambahkan Kategori materi');
        } else {
            return redirect()->route('subkategori-materi.create')->with('error', 'Gagal Menambahkan Kategori materi');
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
        $data['subkategori'] = SubKategoriMateri::find($id);
        $data['kategori'] = KategoriMateri::get();
        return view('backend.subkategori-materi.edit', $data);
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
        $kategori = SubKategoriMateri::find($id);
        $kategori->id_kategori_materi = $request->id_kategori_materi;
        $kategori->nama_subkategori = $request->nama_subkategori;
        $kategori->deskripsi_subkategori = $request->deskripsi_subkategori;
        $kategori->save();
        if($kategori){
            return redirect()->route('subkategori-materi.index')->with('success', 'Berhasil Mengupdate');
        }else{
            return redirect()->route('subkategori-materi.edit',$id_kat)->with('error', 'Gagal Menambahkan');
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
        $delete = SubKategoriMateri::where('id',$id)->delete();
        if($delete){
            return redirect()->route('subkategori-materi.index')->with('success', 'Berhasil Menghapus');
        }else{
            return redirect()->route('subkategori-materi.index')->with('error', 'Gagal Menambahkan');
        }
    }
}
