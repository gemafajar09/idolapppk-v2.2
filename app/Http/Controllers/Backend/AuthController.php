<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AuthController extends Controller
{
    public function index()
    {
        return view('backend.auth.login');
    }

    public function daftar()
    {
        return view('backend.auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'username' => 'required',
            'password' => 'required',
            'jabatan' => 'required'
        ]);

        if ($validator->fails()) {
            return back();
        }

        $simpan = Admin::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'jabatan' => $request->jabatan
        ]);
        return redirect('administrator');
    }

    public function login(Request $request)
    {
        $login = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($login)) {
            $request->session()->regenerate();

            return redirect('backend/home');
        }

        return back();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function profiles()
    {
        return view('backend/profile/index');
    }

    public function usernmaeUp(Request $r, $id)
    {
        $validator = Validator::make($r->all(), [
            'username' => 'required|string',
            'nama' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back();
        }

        $user = Admin::where('id', $id)->update(['nama' => $r->nama, 'username' => $r->username]);

        return back();
    }

    public function passwordUp(request $r, $id)
    {
        $validator = Validator::make($r->all(), [
            'password' => 'required|string',
            'newpassword' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back();
        }
        if ($r->password == $r->newpassword) {
            $user = Admin::where('id', $id)->update(['password' => Hash::make($r->password)]);
        } else {
            return back()->with('error', 'Password Tidak Sama');
        }

        return back()->with('success', 'Berhasil');
    }
}
