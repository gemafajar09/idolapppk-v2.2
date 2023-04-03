<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Iklan;
use App\Helper\HashHelper;

class IklanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['iklans'] = Iklan::get();
        return view('backend.iklan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.iklan.add');
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
        $foto->move('foto/iklan/', $filename);
        $insert = Iklan::insert([
            "foto" => "iklan/".$filename,
            "link" => $request->link,
            "deskripsi" => $request->deskripsi
        ]);
        if ($insert) {
            return redirect()->route('iklan.index')->with('success', 'Berhasil Menambahkan iklan');
        } else {
            return redirect()->route('iklan.create')->with('error', 'Gagal Menambahkan iklan');
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
            return redirect()->back()->with('error', 'Gagal Edit Iklan');
        }
        $data['iklan'] = Iklan::find($id);
        return view('backend.iklan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_iklan)
    {
        $id = HashHelper::decryptData($id_iklan);
        if (!$id) {
            return redirect()->back()->with('error', 'Gagal Edit Iklan');
        }
        $iklan = Iklan::find($id);
        $iklan->link = $request->link;
        if (isset($request->foto)) {
            $foto = $request->file('foto');
            $filename = time(). "." . $foto->getClientOriginalExtension();
            $foto->move('foto/iklan/', $filename);
            $iklan->foto = "iklan/".$filename;
        }
        $iklan->deskripsi = $request->deskripsi;
        $iklan->save();
        if ($iklan) {
            return redirect()->route('iklan.index')->with('success', 'Berhasil Mengupdate iklan');
        } else {
            return redirect()->route('iklan.edit', $id_iklan)->with('error', 'Gagal Menambahkan iklan');
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
            return redirect()->back()->with('error', 'Gagal Hapus iklan');
        }
        $delete = Iklan::where('id', $id)->delete();
        if ($delete) {
            return redirect()->route('iklan.index')->with('success', 'Berhasil Menghapus iklan');
        } else {
            return redirect()->route('iklan.index')->with('error', 'Gagal Menghapus iklan');
        }
    }
}
