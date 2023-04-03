<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Imports\SoalTryout;
use Maatwebsite\Excel\Facades\Excel;

class TryoutakbarController extends Controller
{
    public function index()
    {
        $data['tryout'] = DB::table('tryout_akbar')->get();
        return view('backend.tryout.index', $data);
    }

    public function simpan(Request $r)
    {
        $data['nama_tryout'] = $r->nama_tryout;
        $data['tgl_mulai'] = $r->tgl_mulai;
        $data['tgl_selesai'] = $r->tgl_selesai;
        $data['wkt_mulai'] = $r->wkt_mulai;
        $data['wkt_selesai'] = $r->wkt_selesai;
        $data['durasi'] = $r->durasi;

        $simpan = DB::table('tryout_akbar')->insertGetId($data);


        if ($simpan) {
            return back();
        } else {
            return back();
        }
    }

    public function uploadSoal(Request $r){
        $id = $r->id_tryout;
        $durasi = $r->durasi;
        Excel::import(new SoalTryout($durasi, $id, 0), $r->file, \Maatwebsite\Excel\Excel::XLSX);

        return back();
    }

    public function hapus($id)
    {
        $hapus = DB::table('tryout_akbar')->where('id_tryout', $id)->delete();
        DB::table('soals')->where('id_tryout',$id)->delete();

        return back();
    }
}
