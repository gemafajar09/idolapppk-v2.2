<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TryoutakbarController extends Controller
{
    public function index(){
        $data['data'] = DB::table('tryout_akbar')->get();
        return view('user.pages.tryoutakbar.list',$data);
    }

    public function skortryout($id){
        $data['tryout'] = DB::table('tryout_akbar')->join('mulaiujians','mulaiujians.id_tryout','tryout_akbar.id_tryout')->select(DB::raw('count(mulaiujians.id_tryout) as total'),'tryout_akbar.nama_tryout')->first();
        $data['skor'] = DB::table('skor_tryout')->join('penggunas','penggunas.id','skor_tryout.id_user')->orderBy('skor_tryout.skor','DESC')->paginate(10);
        // dd($data);
        return view('user.pages.tryoutakbar.skor',$data);
    }
}
