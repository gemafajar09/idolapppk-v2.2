<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;
use App\Helper\HashHelper;
use Illuminate\Support\Str;
class ArtikelController extends Controller
{
    public function index()
    {
        $data['artikels'] = Artikel::get();
        return view('backend.article.index',$data);
    }

    public function create()
    {
        return view('backend.article.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $foto = $request->file('foto');
        $filename = time(). "." . $foto->getClientOriginalExtension();
        $foto->move('foto/artikel/', $filename);
        $insert = Artikel::insert([
            "judul"=>$request->judul,
            "foto"=> "artikel/".$filename,
            "isi"=>$request->isi,
            "tipe"=>$request->tipe,
            "slug"=>Str::slug($request->judul, '-')
        ]);
        if($insert){
            return redirect()->route('artikel.index')->with('success', 'Berhasil Menambahkan artikel');
        }else{
            return redirect()->route('artikel.create')->with('error', 'Gagal Menambahkan artikel');
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
            return redirect()->back()->with('error', 'Gagal Edit Artikel');
        }
        $data['artikel'] = Artikel::find($id);
        return view('backend.article.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_artikel)
    {
        $id = HashHelper::decryptData($id_artikel);
        if (!$id) {
            return redirect()->back()->with('error', 'Gagal Edit Artikel');
        }
        $artikel = Artikel::find($id);
        $artikel->judul = $request->judul;
        $artikel->slug = Str::slug($request->judul, '-');
        if (isset($request->foto)){
            $foto = $request->file('foto');
            $filename = time(). "." . $foto->getClientOriginalExtension();
            $foto->move('foto/artikel/', $filename);
            $artikel->foto = "artikel/".$filename;$filename;
        }
        $artikel->isi = $request->isi;
        $artikel->tipe = $request->tipe;
        $artikel->save();
        if($artikel){
            return redirect()->route('artikel.index')->with('success', 'Berhasil Mengupdate artikel');
        }else{
            return redirect()->route('artikel.edit',$id_artikel)->with('error', 'Gagal Menambahkan artikel');
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
            return redirect()->back()->with('error', 'Gagal Hapus Artikel');
        }
        $delete = Artikel::where('id',$id)->delete();
        if($delete){
            return redirect()->route('artikel.index')->with('success', 'Berhasil Menghapus Artikel');
        }else{
            return redirect()->route('artikel.index')->with('error', 'Gagal Menghapus Artikel');
        }
    }
}
