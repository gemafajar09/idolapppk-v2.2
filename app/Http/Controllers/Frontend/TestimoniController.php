<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimoni;
use App\Helper\HashHelper;
class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_pengguna = session('id_pengguna');
        $data['testimoni'] = Testimoni::where('id_pengguna',$id_pengguna)->get();
        return view('user.pages.testimoni.index',$data);
    }

    public function indexForAdmin()
    {
        $data['testimoni'] = Testimoni::get();
        return view('backend.testimoni.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $umur = $request->umur;
        $alamat = $request->alamat;
        $formasi = $request->formasi;
        $testimoni = $request->testimoni;
        $id_pengguna = session('id_pengguna');
        Testimoni::insert([
            "nama"=>$nama,
            "umur"=>$umur,
            "formasi"=>$formasi,
            "alamat"=>$alamat,
            "testimoni"=>$testimoni,
            "id_pengguna"=>$id_pengguna
        ]);
        return back()->with('success',"Testimoni Success");
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            return redirect()->back()->with('error', 'Gagal Hapus Testimoni');
        }
        $delete = Testimoni::where('id',$id)->delete();
        if($delete){
            return redirect()->route('testimoni.admin.index')->with('success', 'Berhasil Menghapus testimoni');
        }else{
            return redirect()->route('testimoni.admin.index')->with('error', 'Gagal Menambahkan testimoni');
        }
    }
}
