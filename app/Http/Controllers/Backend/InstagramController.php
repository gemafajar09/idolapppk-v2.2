<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instagram;
use App\Helper\HashHelper;
class InstagramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['instagram'] = instagram::get();
        return view('backend.instagram.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.instagram.add');
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
        $foto->move('foto/instagram/', $filename);


        $insert = Instagram::create([
            "title"=> $request->title,
            "foto"=> "instagram/".$filename,
            "desk"=> $request->desk,
            "link"=> $request->link
        ]);

        if($insert){
            return redirect()->route('instagram.index')->with('success', 'Berhasil Menambahkan instagram');
        }else{
            return redirect()->route('instagram.create')->with('error', 'Gagal Menambahkan instagram');
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
            return redirect()->back()->with('error', 'Gagal Edit instagram');
        }
        $data['instagram'] = instagram::find($id);
        return view('backend.instagram.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_instagram)
    {
        $id = HashHelper::decryptData($id_instagram);
        if (!$id) {
            return redirect()->back()->with('error', 'Gagal Edit Artikel');
        }
        $instagram = Instagram::find($id);
        $instagram->title = $request->title;

        if (isset($request->foto)){
            $foto = $request->file('foto');
            $filename = time(). "." . $foto->getClientOriginalExtension();
            $foto->move('foto/instagram/', $filename);
            $instagram->foto = "instagram/".$filename;
        }

        $instagram->desk = $request->desk;
        $instagram->link = $request->link;
        $instagram->save();
        if($instagram){
            return redirect()->route('instagram.index')->with('success', 'Berhasil Mengupdate instagram');
        }else{
            return redirect()->route('instagram.edit',$id_instagram)->with('error', 'Gagal Menambahkan instagram');
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
            return redirect()->back()->with('error', 'Gagal Haus instagram');
        }
        $delete = instagram::where('id',$id)->delete();
        if($delete){
            return redirect()->route('instagram.index')->with('success', 'Berhasil Menghapus instagram');
        }else{
            return redirect()->route('instagram.index')->with('error', 'Gagal Menambahkan instagram');
        }
    }
}
