<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Soal;
use App\Models\Paket;
use App\Imports\SoalImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use FIle;

class SoalController extends Controller
{
    public function index()
    {
        $data['soal'] = Soal::join('pakets', 'pakets.id', 'soals.id_paket')->join('fasilitas', 'soals.id_fasilitas', 'fasilitas.id')->select(DB::raw('COUNT(soals.id_soal) as total'), 'fasilitas.nama_fasilitas', 'pakets.id', 'pakets.nama_paket', 'pakets.slug', 'soals.waktu', 'soals.id_fasilitas', 'soals.id_paket')->groupBy('soals.id_paket')->groupBy('soals.id_fasilitas')->get();
        $data['paket'] = Paket::all();

        return view('backend.soal.index', $data);
    }

    public function simpan(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id_paket' => 'required',
            'id_fasilitas' => 'required',
            'file' => 'required|mimes:csv,xlsx|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }

        Excel::import(new SoalImport($r->waktu, $r->id_paket, $r->id_fasilitas), $r->file, \Maatwebsite\Excel\Excel::XLSX);

        return back()->with("success", "Berhasil Disimpan");
    }

    public function soal($id_paket, $id_fasilitas)
    {
        $data['soal'] = Soal::where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->get();
        $data['id_paket'] = $id_paket;
        $data['id_fasilitas'] = $id_fasilitas;
        return view('backend.soal.soal', $data);
    }

    public function fasilitasPilihan($id)
    {
        $data['fasilitas'] = DB::table('fasilitas')->where('id_paket', $id)->where('tipe_fasilitas', 'Ujian')->get();

        return view('backend.soal.fasilitas', $data);
    }

    public function soalHapus($id)
    {
        $hapus = Soal::where('id_soal', $id)->delete();
        if ($hapus == TRUE) {
            return back()->with(['success' => 'Berhasil Dihapus']);
        } else {
            return back()->with(['error' => 'Error']);
        }
    }

    public function hapus($id, $fasilitas)
    {
        $hapus = Soal::where('id_paket', $id)->where('id_fasilitas', $fasilitas)->delete();
        if ($hapus == TRUE) {
            return back()->with(['success' => 'Berhasil Dihapus']);
        } else {
            return back()->with(['error' => 'Error']);
        }
    }

    public function soalEdit(Request $r)
    {
        $data = Soal::where('id_soal', $r->id)->first();
        return response()->json(['data' => $data]);
    }

    public function simpanEdit(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'soal' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'skora' => 'required',
            'skorb' => 'required',
            'skorc' => 'required',
            'skord' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }

        $file = $r->file('gambar');
        $filePembahasan = $r->file('gambar_pembahasan');

        if ($file != '') {
            $r->validate([
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $fileExtension = $file->getClientOriginalExtension();
            $namefilesoal = "image-" . date('Ymdhis') . ".$fileExtension";
            $file->move('upload/soal/img/', $namefilesoal);
            $edit['gambar'] = $namefilesoal;
        }
        $edit['soal'] = $r->soal;
        $edit['a'] = $r->a;
        $edit['b'] = $r->b;
        $edit['c'] = $r->c;
        $edit['d'] = $r->d;
        if ($r->e != '') {
            $edit['e'] = $r->e;
        }
        $edit['jawaban_a'] = $r->skora;
        $edit['jawaban_b'] = $r->skorb;
        $edit['jawaban_c'] = $r->skorc;
        $edit['jawaban_d'] = $r->skord;
        if ($r->skore != '') {
            $edit['jawaban_e'] = $r->skore;
        }


        $edit['pembahasan'] = $r->pembahasan;
        if ($filePembahasan != '') {
            $r->validate([
                'gambar_pembahasan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $fileExtensionn = $filePembahasan->getClientOriginalExtension();
            $namefilepembahasan = "image-" . date('Ymdhis') . ".$fileExtensionn";
            $filePembahasan->move('upload/soal/img/', $namefilepembahasan);
            $edit['pembahasan_gambar'] = $namefilepembahasan;
        }
        $edit['jawaban_terbaik'] = $r->jawaban_terbaik;
        $edit['level'] = $r->level;
        $edit['deskripsi'] = $r->deskripsi;
        $edit['indikator'] = $r->indikator;

        $simpan = Soal::where('id_soal', $r->id_soal)->update($edit);
        if ($simpan == TRUE) {
            return back()->with(['success' => 'Berhasil Diupdate']);
        } else {
            return back()->with(['error' => 'Error']);
        }
    }

    public function cekSkor($id_paket, $id_fasilitas)
    {
        $data = DB::table('skorsoals')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->first();
        if ($data != TRUE) {
            return response()->json(['teknis' => '', 'manajer' => '', 'sosio' => '', 'wawancara' => '']);
        } else {
            return response()->json(['teknis' => $data->teknis, 'manajer' => $data->manajer, 'sosio' => $data->sosio, 'wawancara' => $data->wawancara]);
        }
    }

    public function skorKopetensi(Request $r)
    {
        $cek = DB::table('skorsoals')->where('id_paket', $r->paket)->where('id_fasilitas', $r->fasilitas)->first();
        if ($cek == TRUE) {
            $data = DB::table('skorsoals')->where('id_paket', $r->paket)->where('id_fasilitas', $r->fasilitas)->update(['teknis' => $r->teknis, 'manajer' => $r->manajer, 'sosio' => $r->sosio, 'wawancara' => $r->wawancara]);
        } else {
            $data = DB::table('skorsoals')->insert(['id_paket' => $r->paket, 'id_fasilitas' => $r->fasilitas, 'teknis' => $r->teknis, 'manajer' => $r->manajer, 'sosio' => $r->sosio, 'wawancara' => $r->wawancara]);
        }

        return response()->json($data);
    }

    public function hapusGambar(Request $r)
    {
        if (file_exists(public_path('upload/soal/img/' . $r->gambar))) {
            Soal::where('id_soal', $r->id)->update(['gambar' => '']);
            unlink(public_path('upload/soal/img/' . $r->gambar));
            return response()->json(['success' => 'Berhasil']);
        } else {
            return response()->json(['success' => 'Error']);
        }
    }


    public function hapusGambarSoal(Request $r)
    {
        if (file_exists(public_path('upload/soal/img/' . $r->gambar))) {
            DB::where('id_soal', $r->id)->update(['pembahasan_gambar' => '']);
            unlink(public_path('upload/soal/img/' . $r->gambar));
            return response()->json(['success' => 'Berhasil']);
        } else {
            return response()->json(['success' => 'Error']);
        }
    }

    public function getinformasi($paket = null, $fasilitas = null)
    {
        $data = DB::table('informasisoals')->where('id_paket', $paket)->where('fasilitas', $fasilitas)->first();
        return response()->json($data);
    }

    public function informasiSimpan(Request $r)
    {
        $id_paket = $r->id_paket;
        $id_fasilitas = $r->id_fasilitas;
        $informasi = $r->informasi;

        if ($r->id != null) {
            DB::table('informasisoals')->where('id', $r->id)->update(['informasi' => $informasi]);
        } else {
            DB::table('informasisoals')->insert(['id_paket' => $id_paket, 'id_fasilitas' => $id_fasilitas, 'informasi' => $informasi]);
        }

        return response()->json(['success' => 'Berhasil']);
    }
}
