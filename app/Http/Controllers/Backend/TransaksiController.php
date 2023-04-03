<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Helper\HashHelper;
use App\Models\PembelianDetail;
use App\Models\Pengguna;
use App\Models\HistoriBonus;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
         $data['transaksi'] = DB::table('pembelians')
            ->join('penggunas', 'penggunas.id', 'pembelians.id_pengguna')
            ->join('pembelian_details', 'pembelians.kode_pembelian', 'pembelian_details.kode_pembelian')
            ->join('pakets', 'pembelian_details.id_paket', 'pakets.id')
            ->select('pakets.*','pembelians.*','penggunas.*','pembelian_details.*','pembelians.id as id_pem')
            ->orderBy('pembelians.id', 'desc')->get();

            // dd($data['transaksi']);

        return view('backend.transaksi.index', $data);
    }

    public function update(Request $r, $data)
    {
        $persenAfiliasi = DB::table('persen_afiliasis')->first()->persen ?? 25;
        $result = HashHelper::decryptArray($data);
        if (!$result) {
            return back()->with('error', 'Invalid Kode');
        }
        $id_transaksi = $result['id_transaksi'];
        $kode_pembelian = $result['kode_pembelian'];
        $status = $r->status;
        $tanggal = date('Y-m-d');

        $pembelian = Pembelian::where('id', $id_transaksi);
        DB::beginTransaction();
        try {
            if ($status == "Berhasil") {
                $dataPembelian = $pembelian->first();
                $pengguna = Pengguna::where('kode_afiliasi', $dataPembelian->kode_referal)->where('status_user', 'Aktif');
                $dataPengguna = $pengguna->first();
                if (!empty($dataPembelian->kode_referal) && !empty($dataPengguna)) {
                    $persenKomisi = $dataPembelian->total * ($persenAfiliasi / 100);
                    $pengguna->update([
                        "saldo_afiliasi" => $dataPengguna->saldo_afiliasi + $persenKomisi,
                        "afiliasi_awards" => $dataPengguna->afiliasi_awards + 1
                    ]);
                    $dataUpdate = [
                        "status_pembelian" => $status,
                        "tanggal_aktifasi" => $tanggal,
                        "potong_komisi" => $persenKomisi
                    ];
                    $update = $pembelian->update($dataUpdate);
                    unset($dataUpdate['potong_komisi']);
                    PembelianDetail::where('kode_pembelian', $kode_pembelian)->update($dataUpdate);
                    HistoriBonus::create(["id_pengguna" => $dataPengguna->id, "kode_referal" => $dataPengguna->kode_afiliasi, "bonus_afiliasi" => $dataPembelian->potong_harga, "tanggal_bonus" => $tanggal]);
                } else {
                    // jika tidak menggunakan kode afiliasi
                    $dataUpdate = [
                        "status_pembelian" => $status,
                        "tanggal_aktifasi" => $tanggal
                    ];
                    $update = $pembelian->update($dataUpdate);
                    PembelianDetail::where('kode_pembelian', $kode_pembelian)->update($dataUpdate);
                }
            } else {
                $dataUpdate = [
                    "status_pembelian" => $status,
                    "tanggal_aktifasi" => $tanggal
                ];
                $update = $pembelian->update($dataUpdate);
                PembelianDetail::where('kode_pembelian', $kode_pembelian)->update($dataUpdate);
            }
            DB::commit();
            return back()->with('success', 'Update Transaksi Berhasil');
        } catch (\Exception $th) {
            DB::rollBack();
            return back()->with('error', 'Update Transaksi Gagal');
        }
    }


    public function ferifikasiOnline(Request $r){
        $persenAfiliasi = DB::table('persen_afiliasis')->first()->persen ?? 25;
        // $result = HashHelper::decryptArray($data);
        // if (!$result) {
        //     return back()->with('error', 'Invalid Kode');
        // }
        $id_transaksi = $r->id_transaksi;
        $kode_pembelian = $r->kode_pembelian;
        $status = $r->status;
        $tanggal = date('Y-m-d');

        $pembelian = Pembelian::where('id', $id_transaksi);
        DB::beginTransaction();
        try {
            if ($status == "Berhasil") {
                $dataPembelian = $pembelian->first();
                $pengguna = Pengguna::where('kode_afiliasi', $dataPembelian->kode_referal)->where('status_user', 'Aktif');
                $dataPengguna = $pengguna->first();
                if (!empty($dataPembelian->kode_referal) && !empty($dataPengguna)) {
                    $persenKomisi = $dataPembelian->total * ($persenAfiliasi / 100);
                    $pengguna->update([
                        "saldo_afiliasi" => $dataPengguna->saldo_afiliasi + $persenKomisi,
                        "afiliasi_awards" => $dataPengguna->afiliasi_awards + 1
                    ]);
                    $dataUpdate = [
                        "status_pembelian" => $status,
                        "tanggal_aktifasi" => $tanggal,
                        "potong_komisi" => $persenKomisi
                    ];
                    $update = $pembelian->update($dataUpdate);
                    unset($dataUpdate['potong_komisi']);
                    PembelianDetail::where('kode_pembelian', $kode_pembelian)->update($dataUpdate);
                    HistoriBonus::create(["id_pengguna" => $dataPengguna->id, "kode_referal" => $dataPengguna->kode_afiliasi, "bonus_afiliasi" => $dataPembelian->potong_harga, "tanggal_bonus" => $tanggal]);
                } else {
                    // jika tidak menggunakan kode afiliasi
                    $dataUpdate = [
                        "status_pembelian" => $status,
                        "tanggal_aktifasi" => $tanggal
                    ];
                    $update = $pembelian->update($dataUpdate);
                    PembelianDetail::where('kode_pembelian', $kode_pembelian)->update($dataUpdate);
                }
            } else {
                $dataUpdate = [
                    "status_pembelian" => $status,
                    "tanggal_aktifasi" => $tanggal
                ];
                $update = $pembelian->update($dataUpdate);
                PembelianDetail::where('kode_pembelian', $kode_pembelian)->update($dataUpdate);
            }
            DB::commit();
            // return back()->with('success', 'Update Transaksi Berhasil');
            return response()->json(["status" => 200]);
        } catch (\Exception $th) {
            DB::rollBack();
            // return back()->with('error', 'Update Transaksi Gagal');
            return response()->json(["status" => 404]);
        }
    }
}
