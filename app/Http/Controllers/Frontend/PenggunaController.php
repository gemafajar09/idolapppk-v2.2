<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenggunaRequest;
use App\Http\Requests\PencairanAfiliasiRequest;
use App\Http\Requests\PencairanAward;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Pencairan;
use App\Models\AfiliasiAward;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Helper\HashHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use DB;

class PenggunaController extends Controller
{
    public function registerStore(StorePenggunaRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['saldo_afiliasi'] = 0;
        $validatedData['afiliasi_awards'] = 0;
        $validatedData['status_user'] = "Aktif";
        $validatedData['kode_afiliasi'] = $validatedData['email'];
        $insert = Pengguna::create($validatedData);
        if ($insert) {
            return redirect()->route('frontend.login')->with('success', 'Register Berhasil');
        } else {
            return redirect()->route('frontend.register')->with('error', 'Register Gagal');
        }
    }

    public function loginStore(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $pengguna = new Pengguna();
        $data_pengguna = $pengguna->CheckLoginUser($email, $password);
        if ($data_pengguna) {
            if ($data_pengguna->status_user == "Aktif") {
                Session::put('id', $data_pengguna->id);
                Session::put('nama', $data_pengguna->nama);
                Session::put('email', $data_pengguna->email);
                Session::put('id_pengguna', $data_pengguna->id);
                Session::put('kode_afiliasi', $data_pengguna->kode_afiliasi);
                // redirect ke halaman home
                return redirect()->route('frontend.index');
            } else {
                return back()->with("error", "Account Tidak Aktif");
            }
        } else {
            return back()->with("error", "Username Atau Password Salah");
        }
    }

    public function prosesLogout(Request $request)
    {
        $request->session()->forget('nama');
        $request->session()->forget('id_pengguna');
        // redirect ke halaman home
        return redirect()->route('frontend.login')->with("success", "Logout Berhasil");
    }

    public function profileSaya($id_pengguna)
    {
        $id_pengguna = HashHelper::decryptData($id_pengguna);
        if (!$id_pengguna) {
            return back()->with('error', 'Gagal Load Data');
        }
        try {
            $pengguna = Pengguna::findOrFail($id_pengguna);
        } catch (ModelNotFoundException $error) {
            return back()->with('error', 'Gagal Load Data');
        }
        $data['provinsi'] = Provinsi::all();
        $data['kota'] = Kota::all();
        $data['pengguna'] = $pengguna;
        return view('user.pages.profile.lihat-profile', $data);
    }

    public function updateProfileSaya(StorePenggunaRequest $request, $id_pengguna)
    {
        $id_pengguna = HashHelper::decryptData($id_pengguna);
        if (!$id_pengguna) {
            return back()->with('error', 'Gagal Load Data');
        }
        try {
            $pengguna = Pengguna::findOrFail($id_pengguna);
        } catch (ModelNotFoundException $error) {
            return back()->with('error', 'Gagal Load Data');
        }
        $validatedData = $request->validated();
        $pengguna->nama = $validatedData['nama'];
        $pengguna->email = $validatedData['email'];
        $pengguna->kode_afiliasi = $validatedData['kode_afiliasi'];
        $pengguna->no_telpon = $validatedData['no_telpon'];
        $pengguna->informasi_bank = $validatedData['informasi_bank'];
        $pengguna->no_rekening = $validatedData['no_rekening'];
        $pengguna->id_provinsi = $validatedData['id_provinsi'];
        $pengguna->id_kota = $validatedData['id_kota'];
        $pengguna->id_kota = $validatedData['id_kota'];
        $pengguna->save();
        return back()->with('success', 'Update Data Success');
    }

    public function ubahPasswordSaya($id_pengguna)
    {
        $id_pengguna = HashHelper::decryptData($id_pengguna);
        if (!$id_pengguna) {
            return back()->with('error', 'Gagal Load Data');
        }
        try {
            $pengguna = Pengguna::findOrFail($id_pengguna);
        } catch (ModelNotFoundException $error) {
            return back()->with('error', 'Gagal Load Data');
        }
        $data['pengguna'] = $pengguna;
        return view('user.pages.profile.ubah-password', $data);
    }

    public function updatePasswordSaya(Request $request, $id_pengguna)
    {
        $validator = Validator::make($request->all(), [
            'password_sekarang' => 'required|regex:/^[a-zA-Z0-9_\- ]*$/',
            'password_baru' => 'min:8|regex:/^[a-zA-Z0-9_\- ]*$/|required_with:password_confirmation|same:password_confirmation|max:20',
            'password_confirmation' => 'required|regex:/^[a-zA-Z0-9_\- ]*$/',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $id_pengguna = HashHelper::decryptData($id_pengguna);
            if (!$id_pengguna) {
                return back()->with('error', 'Gagal Load Data');
            }
            try {
                $pengguna = Pengguna::findOrFail($id_pengguna);
            } catch (ModelNotFoundException $error) {
                return back()->with('error', 'Gagal Load Data');
            }
            $password_sekarang = $request->password_sekarang;
            $password_baru = $request->password_baru;
            $password_confirmation = $request->password_confirmation;
            if ($pengguna->password_confirmation == $password_sekarang) {
                $pengguna->password = Hash::make($password_baru);
                $pengguna->password_confirmation = $password_confirmation;
                $pengguna->save();
                return back()->with('success', 'Password Berhasil Diganti');
            } else {
                return back()->with('error', 'Password Sekarang Tidak Valid');
            }
            return redirect()->route('frontend.ubahPasswordSaya')->with('success', 'Update Password Success');
        }
    }

    public function pencairanAfiliasi()
    {
        $id_pengguna = session('id_pengguna');
        $pengguna = Pengguna::findOrFail($id_pengguna);
        $data['pengguna'] = $pengguna;
        $data['pencairan'] = Pencairan::where('id_pengguna', $id_pengguna)->orderBy('id', 'DESC')->get();
        return view('user.pages.profile.pencairan-afiliasi', $data);
    }

    public function prosesPencairanAfiliasi(PencairanAfiliasiRequest $request)
    {
        $validatedData = $request->validated();
        // cek
        $id_pengguna = session('id_pengguna');
        $pengguna = Pengguna::findOrFail($id_pengguna);
        if ($pengguna->saldo_afiliasi < $validatedData['saldo_komisi']) {
            return back()->with('error', 'Pengajuan Pencairan Komisi Gagal,Saldo Tidak Mencukupi');
        }elseif($validatedData['saldo_komisi'] < 15000){
            return back()->with('error', 'Pengajuan Pencairan Komisi Gagal,Minimal 15000');
        }

        $potong = (int)$pengguna->saldo_afiliasi - (int)$validatedData['saldo_komisi'];
        Pengguna::where('id',$id_pengguna)->update(["saldo_afiliasi" => $potong]);
        $kode_pencairan = date('dmy') . uniqid();
        $tanggal = date('Y-m-d');
        $status = "Menunggu Verifikasi";
        $validatedData['secret_kode'] = $kode_pencairan;
        $validatedData['id_pengguna'] = session('id_pengguna');
        $validatedData['tanggal_pencairan'] = $tanggal;
        $validatedData['status_pencairan'] = $status;

        $pencairan = Pencairan::create($validatedData);

        // $total = (int)$pengguna->saldo_afiliasi - (int)$validatedData['saldo_komisi'];
        // DB::table('penggunas')->where('id',$id_pengguna)->update('saldo_afiliasi',$total);

        if ($pencairan) {
            return back()->with('success', 'Pengajuan Pencairan Komisi Berhasil');
        } else {
            return back()->with('error', 'Pengajuan Pencairan Komisi Gagal');
        }
    }

    // Pencairan Affiliasi Award
    public function pencairanAfiliasiAward()
    {
        $id_pengguna = session('id_pengguna');
        $pengguna = Pengguna::findOrFail($id_pengguna);
        $data['pengguna'] = $pengguna;
        $data['afiliasi_award'] = AfiliasiAward::where('id_pengguna', $id_pengguna)->orderBy('id', 'DESC')->get();
        $data['totalcair'] = Pencairan::where('id_pengguna', $id_pengguna)->where('status_pencairan','Valid')->select(DB::Raw('SUM(saldo_komisi) as total'))->first();
        $data['pencairan'] = Pencairan::where('id_pengguna', $id_pengguna)->orderBy('id', 'DESC')->get();
        // dd($data);
        return view('user.pages.profile.afiliasi-award', $data);
    }

    //Proses Pencairan Affiliasi Award
    public function prosesPencairanAfiliasiAward(PencairanAward $request)
    {
        $validatedData = $request->validated();
        // cek
        $id_pengguna = session('id_pengguna');
        $pengguna = Pengguna::findOrFail($id_pengguna);

        //Pengecekan point afiliasi
        if ($pengguna->afiliasi_awards < $validatedData['point_award']) {
            return back()->with('error', 'Pengajuan Pencairan Point Gagal,Point Tidak Mencukupi');
        }

        // generate sercret code
        $kode_pencairan = date('dmy') . uniqid();
        $tanggal = date('Y-m-d');
        $status = "Menunggu Verifikasi";

        // update data database
        $validatedData['secret_code_award'] = $kode_pencairan;
        $validatedData['id_pengguna'] = session('id_pengguna');
        $validatedData['tanggal_award'] = $tanggal;
        $validatedData['status_award'] = $status;
        $award = AfiliasiAward::create($validatedData);

        if ($award) {
            return back()->with('success', 'Pengajuan Award Berhasil');
        } else {
            return back()->with('error', 'Pengajuan Award Gagal');
        }
    }

}
