<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Materi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\KategoriMateri;
class MateriController extends Controller
{
    public function index($id)
    {
        $data['id_paket'] = $id;
        $data['paket'] = Paket::all();
        $data['materi'] = Materi::with('kategorimateri')->where('id_paket', $id)->select(DB::raw('COUNT(materi) as total'), 'id', 'materi', 'id_paket', 'slug','id_kategori_materi','deskripsi_materi')->groupBy('id_kategori_materi','materi')->get();
        $data['kategori'] = KategoriMateri::get();
        return view('backend.materi.index', $data);
    }

    public function detail($id, $materi)
    {
        $data['id_paket'] = $id;
        $data['materi'] = Materi::where('id_paket', $id)->where('slug', $materi)->get();
        return view('backend.materi.detail', $data);
    }

    public function show($file)
    {
        $data['file'] = $file;
        return view('backend.materi.show', $data);
    }

    public function simpan(Request $r)
    {
        if ($r->type == 1) {
            $validator = Validator::make($r->all(), [
                'id_kategori_materi' => 'required',
                'id_paket' => 'required',
                'materi' => 'required|string',
                'deskripsi_materi' => 'string',
                'file.*' => 'required|mimes:pdf|max:2048',
                'type' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->with("error", $validator->errors()->first());
            }

            foreach ($r->file as $i => $files) {
                $file = time() . '_' . $files->getClientOriginalName();
                $files->move('materi', $file);

                $simpan = Materi::insert([
                    'id_kategori_materi' => $r->id_kategori_materi,
                    'id_paket' => $r->id_paket,
                    'materi' => $r->materi,
                    'deskripsi_materi' => $r->deskripsi_materi,
                    'file' => $file,
                    'slug' => Str::slug($r->materi, '-'),
                    'type' => $r->type
                ]);
            }
        } else {
            $validator = Validator::make($r->all(), [
                'id_kategori_materi' => 'required',
                'id_paket' => 'required',
                'materi' => 'required|string',
                'deskripsi_materi' => 'string',
                'file' => 'required',
                'type' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->with("error", $validator->errors()->first());
            }

            $file = $r->file;
            $simpan = Materi::insert([
                'id_kategori_materi' => $r->id_kategori_materi,
                'id_paket' => $r->id_paket,
                'materi' => $r->materi,
                'deskripsi_materi' => $r->deskripsi_materi,
                'file' => $file,
                'slug' => Str::slug($r->materi, '-'),
                'type' => $r->type
            ]);
        }

        return back()->with("success", "Berhasil Disimpan");
    }

    public function update(Request $r)
    {
        if ($r->type == 1) {
            if ($r->file != null) {
                $validator = Validator::make($r->all(), [
                    'materi_e' => 'required|string',
                    'file' => 'required|mimes:pdf|max:2048'
                ]);

                if ($validator->fails()) {
                    return back()->with("error", $validator->errors()->first());
                }
                $data = Materi::where('id', $r->id_e)->first();
                if ($data->type == 1) {
                    unlink('materi/' . $data->file);
                }

                $fileName = time() . '_' . $r->file->getClientOriginalName();
                $r->file('file')->move('materi', $fileName);

                $simpan = Materi::where('id', $r->id_e)->update([
                    'materi' => $r->materi_e,
                    'file' => $fileName,
                    'slug' => Str::slug($r->materi_e, '-')
                ]);
            } else {
                $simpan = Materi::where('id', $r->id_e)->update([
                    'materi' => $r->materi_e,
                    'slug' => Str::slug($r->materi_e, '-')
                ]);
            }
        } else {
            $validator = Validator::make($r->all(), [
                'materi_e' => 'required|string',
                'file_e' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->with("error", $validator->errors()->first());
            }

            $simpan = Materi::where('id', $r->id_e)->update([
                'materi' => $r->materi_e,
                'file' => $r->file_e,
                'slug' => Str::slug($r->materi_e, '-')
            ]);
        }

        if ($simpan == TRUE) {
            return back()->with("success", "Berhasil Diupdate");
        } else {
            return back()->with("error", "Error");
        }
    }

    public function updateMateri(Request $r)
    {
        $materi = $r->materi_asli;
        $id_kategori_materi_edit = $r->id_kategori_materi_edit;

        $simpan = Materi::where('materi', $materi)->update([
            'materi' => $r->materi,
            'id_kategori_materi'=>$id_kategori_materi_edit,
            'slug' => Str::slug($r->materi, '-')
        ]);

        if ($simpan == TRUE) {
            return back()->with("success", "Berhasil Diupdate");
        } else {
            return back()->with("error", "Error");
        }
    }

    public function hapus($id)
    {
        $data = Materi::where('id', $id)->first();
        if ($data->type == 1) {
            unlink('materi/' . $data->file);
        }
        Materi::where('id', $id)->delete();

        return back();
    }

    public function hapusAll($materi)
    {
        $data = Materi::where('slug', $materi)->get();
        foreach ($data as $data) {
            if ($data->type == 1) {
                unlink('materi/' . $data->file);
            }
        }
        Materi::where('slug', $materi)->delete();

        return back();
    }
}
