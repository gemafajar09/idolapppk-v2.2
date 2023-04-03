<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fasilitas;
use App\Models\Paket;
use App\Http\Requests\FasilitasRequest;
use App\Helper\HashHelper;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['fasilitas'] = Fasilitas::get();
        return view('backend.fasilitas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['paket'] = Paket::get();
        return view('backend.fasilitas.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FasilitasRequest $r)
    {
        $validatedData = $r->validated();
        $insert = Fasilitas::insert($validatedData);
        if ($insert) {
            return redirect()->route('fasilitas.index')->with('success', 'Berhasil Menambahkan Fasilitas');
        } else {
            return redirect()->back()->with('error', 'Gagal Menambahkan Fasilitas');
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
            return redirect()->back()->with('error', 'Gagal Menambahkan Fasilitas');
        }
        $data['fasilitas'] = Fasilitas::find($id);
        $data['paket'] = Paket::get();
        return view('backend.fasilitas.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FasilitasRequest $r, $id)
    {
        $id_fasilitas = HashHelper::decryptData($id);
        if (!$id_fasilitas) {
            return redirect()->back()->with('error', 'Gagal Menambahkan Fasilitas');
        }
        $validatedData = $r->validated();
        $update = Fasilitas::where('id',$id_fasilitas)->update($validatedData);
        if ($update) {
            return redirect()->route('fasilitas.index')->with('success', 'Berhasil Mengupdate Fasilitas');
        } else {
            return redirect()->route('fasilitas.edit',$id)->with('error', 'Gagal Mengupdate Fasilitas');
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
        $id_fasilitas = HashHelper::decryptData($id);
        if (!$id_fasilitas) {
            return redirect()->back()->with('error', 'Gagal Mengahpus Fasilitas');
        }
        $delete = Fasilitas::where('id',$id_fasilitas)->delete();
        if ($delete) {
            return redirect()->route('fasilitas.index')->with('success', 'Berhasil Menghapus Fasilitas');
        } else {
            return redirect()->route('fasilitas.index',$id)->with('error', 'Gagal Menghapus Fasilitas');
        }
    }
}
