<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;
use App\Helper\HashHelper;
use App\Models\Tag;
use Illuminate\Support\Str;
class ArtikelController extends Controller
{
    public function index()
    {
        $data['artikels'] = Artikel::get();
        $data['artikels_tags'] = Tag::get();
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

        $tags = explode(",",$request->tags);

        foreach ($tags as $key => $value) {
            if (strlen(trim($value)) == 0) continue;

            $tag = Tag::where('value', trim($value))->first();
            if (!$tag) {
                $tag = Tag::create([
                    'value' => trim($value),
                    'view' => 0
                ]);
            }
            $tag_id[] = $tag->id;
        }

        $insert = Artikel::create([
            "judul"=> $request->judul,
            "foto"=> "artikel/".$filename,
            "tags"=> json_encode($tag_id),
            "foto_cite"=> $request->foto_cite,
            "isi"=> $request->isi,
            "tipe"=> $request->tipe,
            "slug"=> Str::slug($request->judul, '-')
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
        $data['artikels_tags'] = Tag::get();
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

        $tags = explode(",",$request->tags);

        foreach ($tags as $key => $value) {
            if (strlen(trim($value)) == 0) continue;
            $tag = Tag::where('value', trim($value))->first();
            if (!$tag) {
                $tag = Tag::create([
                    'value' => trim($value),
                    'view' => 0
                ]);
            }
            $tag_id[] = $tag->id;
        }

        $artikel->slug = Str::slug($request->judul, '-');
        if (isset($request->foto)){
            $foto = $request->file('foto');
            $filename = time(). "." . $foto->getClientOriginalExtension();
            $foto->move('foto/artikel/', $filename);
            $artikel->foto = "artikel/".$filename;$filename;
        }
        $artikel->tags = json_encode($tag_id);
        $artikel->isi = $request->isi;
        $artikel->foto_cite = $request->foto_cite;
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

    public function artikelBanner(Request $request)
    {
        $files = scandir('foto/banner/');

        if (isset($request->foto)){
            $foto = $request->file('foto');
            $filename = time(). "." . $foto->getClientOriginalExtension();
            $foto->move('foto/banner/', $filename);

            for ($i=2; $i < count($files); $i++) {
                unlink('foto/banner/'.$files[$i]);
            }

            return redirect()->route('artikel.index')->with('success', 'Berhasil mengubah banner artikel');
        }


        return redirect()->route('artikel.index')->with('error', 'Gagal mengubah banner artikel');
    }
}
