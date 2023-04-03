<?php

namespace App\Http\Controllers\Ujian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsoalController extends Controller
{
    public function index(Request $r)
    {
        $id_paket = $r->id_paket;
        $id_soal = $r->id_soal;
        $id_fasilitas = $r->id_fasilitas;
        $kategori_laporan = $r->kategori_laporan;
        $laporan = $r->laporan;
        $tgl_lapor = date('Y-m-d');

        $simpan = DB::table('reportsoals')->insert(
            [
                'id_paket' => $id_paket,
                'id_fasilitas' => $id_fasilitas,
                'id_soal' => $id_soal,
                'kategori_laporan' => $kategori_laporan,
                'laporan' => $laporan,
                'tgl_lapor' => $tgl_lapor
            ]
        );
        if ($simpan == TRUE) {
            return back();
        } else {
            return back();
        }
    }
}
