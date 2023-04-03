<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;
use App\Helper\HashHelper;
class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kontak'] = Kontak::get();
        return view('backend.kontak.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.kontak.add');
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
        $link = $request->link;
        $icon = $request->icon;
        $insert = Kontak::insert([
            "nama"=>$nama,
            "link"=>$link,
            "icon"=>$icon
        ]);
        if($insert){
            return redirect()->route('kontak.index')->with('success', 'Berhasil Menambahkan kontak');
        }else{
            return redirect()->route('kontak.create')->with('error', 'Gagal Menambahkan kontak');
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
            return redirect()->back()->with('error', 'Gagal Edit Kontak');
        }
        $data['kontak'] = Kontak::find($id);
        return view('backend.kontak.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kontak)
    {
        $id = HashHelper::decryptData($id_kontak);
        if (!$id) {
            return redirect()->back()->with('error', 'Gagal Edit Kontak');
        }
        $kontak = Kontak::find($id);
        $kontak->nama = $request->nama;
        $kontak->link = $request->link;
        $kontak->icon = $request->icon;
        $kontak->save();
        if($kontak){
            return redirect()->route('kontak.index')->with('success', 'Berhasil Mengupdate kontak');
        }else{
            return redirect()->route('kontak.edit',$id_kontak)->with('error', 'Gagal Menambahkan kontak');
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
            return redirect()->back()->with('error', 'Gagal Haus Kontak');
        }
        $delete = Kontak::where('id',$id)->delete();
        if($delete){
            return redirect()->route('kontak.index')->with('success', 'Berhasil Menghapus kontak');
        }else{
            return redirect()->route('kontak.index')->with('error', 'Gagal Menambahkan kontak');
        }
    }
}
