<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TestimoniController extends Controller
{
    public function index(){
        $data['testimoni'] = DB::Table('testimonial')->get();
        return view('backend.testimoni2.index',$data);
    }

    public function simpan(Request $r, $id){
         $validator = Validator::make($r->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|mimes:csv,xlsx|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }

        $nama = $r->nama;
        $deskripsi = $r->deskripsi;

        $file = time() . '_' . $r->foto->getClientOriginalName();
        $r->foto->move('testimoni', $file);

        $data = [
            'foto' => $file,
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'tanggal' => date('Y-m-d')
        ];
        $simpan = DB::table('testimonial')->insert($data);
        if($simpan){
            return back();
        }else{
            return back()->with('pesan','Gagal Diinputkan');
        }
    }

    public function hapus($id){
        $hapus = DB::table('testimonial')->delete();
        if($hapus){
            return back();
        }else{
            return back();
        }
    }
}
