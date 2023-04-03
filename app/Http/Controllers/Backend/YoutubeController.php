<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Youtube;
use App\Helper\HashHelper;
class YoutubeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['youtube'] = Youtube::get();
        return view('backend.youtube.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.youtube.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $link = $request->link;
        $lokasi = $request->lokasi;
        $insert = Youtube::insert([
            "link"=>$link,
            "lokasi"=>$lokasi
        ]);
        if($insert){
            return redirect()->route('youtube.index')->with('success', 'Berhasil Menambahkan youtube');
        }else{
            return redirect()->route('youtube.create')->with('error', 'Gagal Menambahkan youtube');
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
        $data['youtube'] = Youtube::find($id);
        return view('backend.youtube.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_youtube)
    {
        $id = HashHelper::decryptData($id_youtube);
        if (!$id) {
            return redirect()->back()->with('error', 'Gagal Edit');
        }
        $youtube = Youtube::find($id);
        $youtube->lokasi = $request->lokasi;
        $youtube->link = $request->link;
        $youtube->save();
        if($youtube){
            return redirect()->route('youtube.index')->with('success', 'Berhasil Mengupdate youtube');
        }else{
            return redirect()->route('youtube.edit',$id_youtube)->with('error', 'Gagal Menambahkan youtube');
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
            return redirect()->back()->with('error', 'Gagal Haus youtube');
        }
        $delete = Youtube::where('id',$id)->delete();
        if($delete){
            return redirect()->route('youtube.index')->with('success', 'Berhasil Menghapus youtube');
        }else{
            return redirect()->route('youtube.index')->with('error', 'Gagal Menambahkan youtube');
        }
    }
}
