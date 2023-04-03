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
        $data['iklans'] = Instagram::get();
        return view('backend.instagram.index', $data);
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
        $insert = Instagram::insert([
            "embed" => $request->deskripsi
        ]);
        if ($insert) {
            return redirect()->route('instagram.index')->with('success', 'Berhasil Menambahkan iklan');
        } else {
            return redirect()->route('instagram.create')->with('error', 'Gagal Menambahkan iklan');
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
        $data['iklan'] = Instagram::find($id);
        return view('backend.instagram.edit', $data);
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
            return redirect()->back()->with('error', 'Gagal Hapus instagram');
        }
        $delete = Instagram::where('id', $id)->delete();
        if ($delete) {
            return redirect()->route('instagram.index')->with('success', 'Berhasil Menghapus instagram');
        } else {
            return redirect()->route('instagram.index')->with('error', 'Gagal Menghapus instagram');
        }
    }
}
