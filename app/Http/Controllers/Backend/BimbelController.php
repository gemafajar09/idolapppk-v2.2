<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BimbelController extends Controller
{
    public function index()
    {
        return view('backend.paket_bimbel.index');
    }
}
