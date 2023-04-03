<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pencairan;
use App\Models\AfiliasiAward;
use App\Models\Pengguna;
use App\Helper\HashHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;

class AfiliasiController extends Controller
{
    public function index()
    {
        $data['pencairan'] = Pencairan::with('pengguna')->latest()->get();
        return view('backend.afiliasi.index', $data);
    }

    public function update(Request $r, $data)
    {
        $result = HashHelper::decryptArray($data);
        if (!$result) {
            return back()->with('error', 'Invalid Kode');
        }
        $id_pencairan = $result['id'];
        $status = $r->status;
        try {
            $pencairan = Pencairan::findOrFail($id_pencairan);
            $id_pengguna = $pencairan->id_pengguna;
            $saldo_komisi = $pencairan->saldo_komisi;
            DB::beginTransaction();
            try {
                if ($status == "Valid") {
                    $pengguna = Pengguna::where('id', $id_pengguna);
                    $dataPengguna = $pengguna->first();
                    // if (!empty($dataPengguna)) {
                    //     if($dataPengguna->saldo_afiliasi < $saldo_komisi){
                    //         return back()->with('error', 'Saldo Tidak Mencukupi');
                    //     }
                    //     $pengguna->update([
                    //         "saldo_afiliasi" => $dataPengguna->saldo_afiliasi - $saldo_komisi
                    //     ]);
                    // }
                    $pencairan->status_pencairan = $status;
                    $pencairan->save();
                } elseif ($status == "Tidak Valid") {
                    $pengguna = Pengguna::where('id', $id_pengguna);
                    $dataPengguna = $pengguna->first();
                    $potong = $dataPengguna->saldo_afiliasi + $saldo_komisi;
                    Pengguna::where('id',$id_pengguna)->update(['saldo_afiliasi' => $potong]);

                    $pencairan->status_pencairan = $status;
                    $pencairan->save();
                }
                DB::commit();
                return back()->with('success', 'Update Status Pencairan Berhasil');
            } catch (\Exception $th) {
                dd($th->getMessage());
                DB::rollBack();
                return back()->with('error', 'Pencairan Gagal1');
            }
        } catch (ModelNotFoundException $th) {
            return back()->with('error', 'Pencairan Gagal2');
        }
    }

    public function halamanAward()
    {
        $data['award'] = AfiliasiAward::with('pengguna')->latest()->get();
        return view('backend.afiliasi-award.index', $data);
    }

    public function updateAward(Request $r, $data)
    {
        $result = HashHelper::decryptArray($data);
        if (!$result) {
            return back()->with('error', 'Invalid Kode');
        }
        // dd($result);
        $id_award = $result['id'];
        $status = $r->status;
        try {
            $award = AfiliasiAward::findOrFail($id_award);
            $id_pengguna = $award->id_pengguna;
            $point_award = $award->point_award;
            // dd($id_pengguna , $point_award);
            DB::beginTransaction();
            try {
                if ($status == "Valid") {
                    $pengguna = Pengguna::where('id', $id_pengguna);
                    $dataPengguna = $pengguna->first();
                    // dd($dataPengguna);
                    if (!empty($dataPengguna)) {
                        if($dataPengguna->afiliasi_awards < $point_award){
                            return back()->with('error', 'Point Tidak Mencukupi');
                        }
                        $pengguna->update([
                            "afiliasi_awards" => $dataPengguna->afiliasi_awards - $point_award
                        ]);
                    }
                    $award->status_award = $status;
                    $award->save();
                } elseif ($status == "Tidak Valid") {
                    $award->status_award = $status;
                    $award->save();
                }
                DB::commit();
                return back()->with('success', 'Update Status Award Berhasil');
            } catch (\Exception $th) {
                dd($th->getMessage());
                DB::rollBack();
                return back()->with('error', 'Award Gagal1');
            }
        } catch (ModelNotFoundException $th) {
            return back()->with('error', 'Award Gagal2');
        }
    }
}