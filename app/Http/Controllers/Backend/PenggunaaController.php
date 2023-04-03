<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Helper\HashHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class PenggunaaController extends Controller
{
    public function index(){
        $data['pengguna'] = Pengguna::latest()->get();
        return view('backend.pengguna.index',$data);
    }
    public function update(Request $r,$id){
        $resultId = HashHelper::decryptData($id);
        if (!$resultId) {
            return back()->with('error', 'Invalid Kode');
        }
        $statusUser = $r->status_user;
        try {
            $pengguna = Pengguna::find($resultId);
            $pengguna->status_user = $statusUser;
            $pengguna->save();
            return back()->with('success','Update Status User Berhasil');
        } catch (ModelNotFoundException $th) {
            return back()->with('error','Update Status User Gagal');

        }
    }
}
