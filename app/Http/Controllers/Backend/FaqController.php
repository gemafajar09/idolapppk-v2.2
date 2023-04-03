<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Helper\HashHelper;
class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['faq'] = Faq::get();
        return view('backend.faq.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.faq.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pertanyaan = $request->pertanyaan;
        $jawaban = $request->jawaban;
        $insert = Faq::insert([
            "pertanyaan"=>$pertanyaan,
            "jawaban"=>$jawaban
        ]);
        if($insert){
            return redirect()->route('faq.index')->with('success', 'Berhasil Menambahkan Faq');
        }else{
            return redirect()->route('faq.create')->with('error', 'Gagal Menambahkan Faq');
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
            return redirect()->back()->with('error', 'Gagal Edit Faq');
        }
        $data['faq'] = Faq::find($id);
        return view('backend.faq.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_faq)
    {
        $id = HashHelper::decryptData($id_faq);
        if (!$id) {
            return redirect()->back()->with('error', 'Gagal Edit Faq');
        }
        $faq = Faq::find($id);
        $faq->pertanyaan = $request->pertanyaan;
        $faq->jawaban = $request->jawaban;
        $faq->save();
        if($faq){
            return redirect()->route('faq.index')->with('success', 'Berhasil Mengupdate Faq');
        }else{
            return redirect()->route('faq.edit',$id_faq)->with('error', 'Gagal Menambahkan Faq');
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
            return redirect()->back()->with('error', 'Gagal Hapus Faq');
        }
        $delete = Faq::where('id',$id)->delete();
        if($delete){
            return redirect()->route('faq.index')->with('success', 'Berhasil Menghapus Faq');
        }else{
            return redirect()->route('faq.index')->with('error', 'Gagal Menambahkan Faq');
        }
    }
}
