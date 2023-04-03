<?php

use App\Http\Controllers\Frontend\{
    BerandaController,
    PembelianController
};
use App\Http\Controllers\Backend\{
    HomeController,
    TransaksiController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('histori/bonus', [BerandaController::class, 'apiHistoriBonus'])->name('api.histori.bonus');
Route::get('histori/pendapatan/bersih', [HomeController::class, 'apiHistoriPendapatanBersih'])->name('api.total.pendapatan');

Route::get('cekPembayaran/{id}', [PembelianController::class, 'cekPembayaran'])->name('api.pembayaran');
Route::post('ferifikasiOnline', [TransaksiController::class, 'ferifikasiOnline'])->name('api.ferifikasiOnline');
