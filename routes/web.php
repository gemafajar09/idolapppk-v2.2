<?php

use Illuminate\Support\Facades\Route;
// backend
use App\Http\Controllers\Backend\InstagramController;

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\PaketController;
use App\Http\Controllers\Backend\MateriController;
use App\Http\Controllers\Backend\SoalController;
use App\Http\Controllers\Backend\TestimoniController as Backtestimoni;

use App\Http\Controllers\Backend\TransaksiController;
use App\Http\Controllers\Backend\PenggunaaController;
use App\Http\Controllers\Backend\AfiliasiController;
use App\Http\Controllers\Backend\FasilitasController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\KontakController;
use App\Http\Controllers\Backend\KategoriPaketController;
use App\Http\Controllers\Backend\KategoriMateriController;
use App\Http\Controllers\Backend\SubKategoriMateriController;
use App\Http\Controllers\Backend\ArtikelController;
use App\Http\Controllers\Backend\IklanController;
use App\Http\Controllers\Backend\YoutubeController;
use App\Http\Controllers\Backend\LaporanController;
use App\Http\Controllers\Backend\BimbelController;
// ujian
use App\Http\Controllers\Ujian\UjianController;
use App\Http\Controllers\Ujian\ReportsoalController;
// frontend
use App\Http\Controllers\Frontend\PaketController as PaketFrontendController;
use App\Http\Controllers\Frontend\PenggunaController;
use App\Http\Controllers\Frontend\PembelianController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\BerandaController;
use App\Http\Controllers\Frontend\TestimoniController;
// tryout
use App\Http\Controllers\Backend\TryoutakbarController;

use App\Http\Controllers\Frontend\TryoutakbarController as Tryoutakbar;

Route::group(
    ['middleware' => 'guest:admin'],
    function () {
        Route::get('administrator', [AuthController::class, 'index'])->name('administrator');
        Route::get('admin-daftar', [AuthController::class, 'daftar'])->name('admin-daftar');
        Route::post('admin-login', [AuthController::class, 'login'])->name('admin-login');
        Route::post('admin-register', [AuthController::class, 'register'])->name('admin-register');
    }
);

Route::group(
    ['middleware' => ['web', 'auth:admin'], 'prefix' => 'backend'],
    function () {
        // testimoni
        Route::get('testimoni-admin', [Backtestimoni::class, 'index'])->name('testimoni-admin');
        Route::post('testimoni-simpan', [Backtestimoni::class, 'simpan'])->name('testimoni-simpan');
        Route::delete('testimoni-hapus/{id}', [Backtestimoni::class, 'hapus'])->name('testimoni-hapus');

        Route::resource('instagram', InstagramController::class);
        // tryout
        Route::get('tryoutAkbar', [TryoutakbarController::class, 'index'])->name('tryoutAkbar');
        Route::get('tryoutAkbar-hapus/{id}', [TryoutakbarController::class, 'hapus'])->name('tryoutAkbar-hapus');
        Route::post('tryoutAkbar-simpan', [TryoutakbarController::class, 'simpan'])->name('tryoutAkbar-simpan');
        Route::post('tryoutAkbar-upload', [TryoutakbarController::class, 'uploadSoal'])->name('tryoutAkbar-upload');
        // home
        Route::get('home/{cari?}', [HomeController::class, 'index'])->name('home');
        // paket
        Route::get('paket', [PaketController::class, 'index'])->name('paket');
        Route::post('paket-add', [PaketController::class, 'simpan'])->name('paket-add');
        Route::post('paket-get', [PaketController::class, 'getdata'])->name('paket-get');
        Route::post('paket-update', [PaketController::class, 'update'])->name('paket-update');
        Route::get('paket-hapus/{id}', [PaketController::class, 'hapus'])->name('paket-hapus');
        // materi
        Route::get('materi/{id}', [MateriController::class, 'index'])->name('materi');
        Route::get('materi-detail/{id}/{materi}', [MateriController::class, 'detail'])->name('materi-detail');
        Route::get('materi-show/{materi}', [MateriController::class, 'show'])->name('materi-show');
        Route::post('materi-update-name', [MateriController::class, 'updateMateri'])->name('materi-update-name');
        Route::post('materi-add', [MateriController::class, 'simpan'])->name('materi-add');
        Route::post('materi-update', [MateriController::class, 'update'])->name('materi-update');
        Route::get('materi-hapus/{id}', [MateriController::class, 'hapus'])->name('materi-hapus');
        Route::get('materi-hapus-all/{id}', [MateriController::class, 'hapusAll'])->name('materi-hapus-all');
        // soal
        Route::get('soal', [SoalController::class, 'index'])->name('soal');
        Route::get('soal-delete/{id}/{fasilitas}', [SoalController::class, 'hapus'])->name('soal-delete');
        Route::get('select-fasilitas/{id}', [SoalController::class, 'fasilitasPilihan'])->name('select-fasilitas');
        // soal-list
        Route::get('soal-list/{id_paket}/{id_fasilitas}', [SoalController::class, 'soal'])->name('soal-list');
        Route::get('soal-list-delete/{id}', [SoalController::class, 'soalHapus'])->name('soal-list-delete');
        Route::get('soal-list-edit/{id}', [SoalController::class, 'soalEdit'])->name('soal-list-edit');
        Route::post('soal-list-update', [SoalController::class, 'simpanEdit'])->name('soal-list-update');
        Route::post('soal-add', [SoalController::class, 'simpan'])->name('soal-add');
        // kelas order
        Route::get('kelas-order', [KelasorderController::class, 'index'])->name('kelas-order');
        // Affiliasi
        Route::get('affiliasi', [AffiliasiController::class, 'index'])->name('affiliasi');
        // logout
        Route::post('logouts', [AuthController::class, 'logout'])->name('logouts');

        // transaksi
        Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::put('transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');

        // pengguna
        Route::get('pengguna', [PenggunaaController::class, 'index'])->name('pengguna.index');
        Route::put('pengguna/{id}', [PenggunaaController::class, 'update'])->name('pengguna.update');

        // pencairan afiliasi
        Route::get('pencairan', [AfiliasiController::class, 'index'])->name('pencairan.index');
        Route::put('pencairan/{id}', [AfiliasiController::class, 'update'])->name('pencairan.update');

        //Point Award
        Route::get('pencairan-award', [AfiliasiController::class, 'halamanAward'])->name('pencairan-award.index');
        Route::put('pencairan-award/{id}', [AfiliasiController::class, 'updateAward'])->name('pencairan-award.update');
        // fasilitas
        Route::resource('fasilitas', FasilitasController::class);
        Route::resource('faq', FaqController::class);
        Route::resource('kontak', KontakController::class);
        Route::resource('kategori-paket', KategoriPaketController::class);
        Route::resource('kategori-materi', KategoriMateriController::class);
        Route::resource('artikel', ArtikelController::class);
        Route::put('artikelBanner', [ArtikelController::class, 'artikelBanner'])->name('artikelBanner');

        Route::resource('iklan', IklanController::class);
        Route::resource('youtube', YoutubeController::class);

        Route::get('testimoni', [TestimoniController::class, 'indexForAdmin'])->name('testimoni.admin.index');
        Route::delete('testimoni/{id}', [TestimoniController::class, 'destroy'])->name('testimoni.admin.delete');
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/pendapatan', [LaporanController::class, 'laporanPendapatan'])->name('laporan.pendapatan');
        Route::get('laporan/pencairan', [LaporanController::class, 'laporanPencairan'])->name('laporan.pencairan');

        Route::get('laporan/soal', [LaporanController::class, 'laporanSoal'])->name('laporan.soal');

        // profile
        Route::get('profil', [AuthController::class, 'profiles'])->name('profil');
        Route::post('update-username/{id}', [AuthController::class, 'usernmaeUp'])->name('update-username');
        Route::post('update-password/{id}', [AuthController::class, 'passwordUp'])->name('update-password');

        // hapus Gmabar soal
        Route::post('hapus-gambar', [SoalController::class, 'hapusGambar'])->name('hapus-gambar');
        Route::post('hapus-pembahasanGambar', [SoalController::class, 'hapusGambarSoal'])->name('hapus-pembahasanGambar');

        // informasi
        Route::get('informasi-ambil/{paket?}/{fasilitas?}', [SoalController::class, 'getinformasi'])->name('informasi-ambil');
        Route::post('informasi-simpan', [SoalController::class, 'informasiSimpan'])->name('informasi-simpan');

        // bimbel
        Route::get('bimbel', [BimbelController::class, 'index'])->name('bimbel');
    }
);

Route::group(['prefix' => 'ujian'], function () {
    Route::get('ujian/{id_paket}/{id_fasilitas}', [UjianController::class, 'index'])->name('ujian');
    Route::post('ujian-mulai', [UjianController::class, 'mulaiUjian'])->name('ujian-mulai');
    Route::get('start/{id_ujian}/{id_paket}/{id_fasilitas}/{no?}', [UjianController::class, 'start'])->name('start');
    Route::post('simpan-ujian/{id_ujian}/{id_paket}/{id_fasilitas}', [UjianController::class, 'jawaban'])->name('simpan-ujian');
    Route::post('ujian-finis/{iduser}/{id_paket}/{id_ujian}/{id_fasilitas}', [UjianController::class, 'finish'])->name('ujian-finis');

    Route::post('report-soal', [ReportsoalController::class, 'index'])->name('report-soal');

    Route::get('hasil-ujian/{id_ujian}/{id_fasilitas}/{id_paket}', [UjianController::class, 'grafikujian'])->name('hasil-ujian');
    Route::get('review-ujian/{id_ujian}/{id_fasilitas}/{id_paket}/{no?}', [UjianController::class, 'reviewujian'])->name('review-ujian');

    Route::get('cekSkor/{paket}/{fasilitas}', [SoalController::class, 'cekSkor'])->name('cekSkor');
    Route::post('skorKopetensi', [SoalController::class, 'skorKopetensi'])->name('skorKopetensi');
});

// tanpa middleware
Route::get('/', [BerandaController::class, 'index'])->name('frontend.index');
Route::get('/password-reset/{id}', [BerandaController::class, 'halamanReset'])->name('password-reset');
Route::post('/password-update/{id}', [BerandaController::class, 'updatePassword'])->name('password-update');
// sementara

Route::middleware(['belum_login'])->group(function () {
    Route::get('/register/{referal?}', [BerandaController::class, 'register'])->name('frontend.register');
    Route::post('/register', [PenggunaController::class, 'registerStore'])->name('frontend.register.store');
    Route::get('/login', [BerandaController::class, 'login'])->name('frontend.login');
    Route::post('/reset-password', [BerandaController::class, 'resetPassword'])->name('frontend.reset.password');
    Route::post('/login', [PenggunaController::class, 'loginStore'])->name('frontend.login.store');
    Route::get('/artikel', [BerandaController::class, 'artikel'])->name('frontend.artikel');
    Route::get('/artikel-tags/{id}', [BerandaController::class, 'artikelTags'])->name('frontend.artikelTags');
    Route::get('/artikel/{slug}', [BerandaController::class, 'detailArtikel'])->name('frontend.detailArtikel');
});

Route::middleware(['sudah_login'])->group(function () {
    Route::get('/paket/kategori', [PaketFrontendController::class, 'paketKategori'])->name('frontend.paketKategori');
    Route::get('/paket/kategori/{id}/{type}', [PaketFrontendController::class, 'paketKategoriDetail'])->name('frontend.paketKategoriDetail');
    Route::get('/paket/all', [PaketFrontendController::class, 'paketAll'])->name('frontend.paketAll');
    Route::get('/paket/detail/{slug}', [PaketFrontendController::class, 'paketDetail'])->name('frontend.paketDetail');
    Route::get('/keranjang', [PembelianController::class, 'viewKeranjang'])->name('frontend.keranjang');
    Route::post('/keranjang', [PembelianController::class, 'prosesKeranjang'])->name('frontend.keranjang.proses');
    Route::post('/keranjang/delete', [PembelianController::class, 'deleteKeranjang'])->name('frontend.keranjang.delete');
    Route::post('/pakai/kode/afiliasi', [PembelianController::class, 'setKodeAfiliasi'])->name('frontend.keranjang.setKodeAfiliasi');
    Route::get('/remove/kode/afiliasi', [PembelianController::class, 'removeKodeAfiliasi'])->name('frontend.checkout.removeKodeAfiliasi');
    Route::get('/checkout', [PembelianController::class, 'checkout'])->name('frontend.checkout');
    Route::post('/checkout-proses', [PembelianController::class, 'prosesCheckout'])->name('frontend.checkout.proses');
    Route::get('/billing/{kode_pembelian}/{tokn}', [PembelianController::class, 'billing'])->name('frontend.billing');
    Route::get('/logout', [PenggunaController::class, 'prosesLogout'])->name('frontend.logout');
    Route::get('/profile-saya/{id}', [PenggunaController::class, 'profileSaya'])->name('frontend.profileSaya');
    Route::put('/update/profile-saya/{id}', [PenggunaController::class, 'updateProfileSaya'])->name('frontend.updateProfileSaya');
    Route::get('/ubah-password/{id}', [PenggunaController::class, 'ubahPasswordSaya'])->name('frontend.ubahPasswordSaya');
    Route::put('/update-password/{id}', [PenggunaController::class, 'updatePasswordSaya'])->name('frontend.updatePasswordSaya');
    Route::get('/histori-pembelian/{id}', [PembelianController::class, 'historiPembelian'])->name('frontend.historipembelian');
    Route::post('/hapus-keranjang', [PembelianController::class, 'hapusKeranjang'])->name('hapus-keranjang');
    Route::post('/checkout/batal', [PembelianController::class, 'batalCheckout'])->name('frontend.checkout.batal');

    // pencairan Komisi
    Route::get('/pencairan/afiliasi', [PenggunaController::class, 'pencairanAfiliasi'])->name('frontend.pencairan.afiliasi');
    Route::post('/pencairan/afiliasi/proses', [PenggunaController::class, 'prosesPencairanAfiliasi'])->name('frontend.pencairan.afiliasi.proses');

    //Afilliasi Award
    Route::get('/pencairan/afiliasi-award', [PenggunaController::class, 'pencairanAfiliasiAward'])->name('frontend.pencairan.afiliasi.award');
    Route::post('/pencairan/afiliasi-award/proses', [PenggunaController::class, 'prosesPencairanAfiliasiAward'])->name('frontend.pencairan.afiliasi.award.proses');

    // service
    Route::get('/paket-saya', [ServiceController::class, 'paketSaya'])->name('frontend.service.paketSaya');
    Route::get('/hasil/try-out', [ServiceController::class, 'hasilTryOut'])->name('frontend.service.hasilTryOut');

    Route::resource('testimoni', TestimoniController::class);

    Route::get('/paket-saya/materi/{id_paket}/{slug?}/{id_materi?}', [ServiceController::class, 'materiPaketSaya'])->name('frontend.service.materiPaketSaya');
    Route::get('/paket-saya/materi-pdf/{id_paket}/{slug?}/{id_materi?}', [ServiceController::class, 'materiPaketSayaPdf'])->name('frontend.service.materiPaketSayaPdf');
    Route::get('/paket-saya/detailmateri/{id_paket}/{id_kategori?}', [ServiceController::class, 'materiPaketSayaDetail'])->name('frontend.service.materiPaketSayaDetail');
    Route::get('/paket-saya/detail-materi-pdf/{id_paket}/{id_kategori?}', [ServiceController::class, 'materiPaketSayaPdfDetail'])->name('frontend.service.materiPaketSayaPdfDetail');

    Route::get('/tryout', [Tryoutakbar::class, 'index'])->name('frontend.tryout-akbar');
    Route::get('/tryout-skor/{id}', [Tryoutakbar::class, 'skortryout'])->name('frontend.tryout-skor');
});

