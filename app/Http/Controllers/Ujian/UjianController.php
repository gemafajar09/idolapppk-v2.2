<?php

namespace App\Http\Controllers\Ujian;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\Mulaiujian;
use App\Models\Jawaban;
use App\Models\Paket;
use App\Models\Informasisoal;
use App\Helper\HashHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UjianController extends Controller
{
    public function index($id_pak, $id_fas)
    {
        $id_paket = HashHelper::decryptData($id_pak);
        $data['id_fasilitas'] = HashHelper::decryptData($id_fas);
        if (!$id_paket) {
            return back()->with('error', 'Invalid Kode Paket');
        }
        try {
            $data['paket'] = Paket::findOrFail($id_paket);
            $data['informasi'] = Informasisoal::where('id_paket', $id_paket)->where('id_fasilitas', HashHelper::decryptData($id_fas))->first();
        } catch (ModelNotFoundException $error) {
            return back()->with('error', 'Paket Tidak Ditemukan');
        }

        $data['no'] = 0;
        return view('ujian.persiapan', $data);
    }

    public function mulaiUjian(Request $r)
    {
        date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
        $date = date('Y-m-d');
        $id_user = session('id_pengguna');
        $id_paket = $r->id_paket;
        $id_fasilitas = $r->id_fasilitas;
        $waktus = DB::table('soals')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->select('waktu')->groupBy('waktu')->first();

        // cari waktu akhir
        // $date = date_create(date('H:i:s'));
        $date = date_create($r->waktus);
        date_add($date, date_interval_create_from_date_string($waktus->waktu . ' Minutes'));
        $selesai = date_format($date, 'Y-m-d H:i:s');
        $id_ujian = Mulaiujian::insertGetId([
            'id_user' => $id_user,
            'id_paket' => $id_paket,
            'id_fasilitas' => $id_fasilitas,
            'tgl_mulai' => $date,
            'alokasi_Waktu' => $waktus->waktu,
            'waktu_mulai' => $r->waktu_mulai,
            'waktu_selesai' => $selesai
        ]);
        return redirect('ujian/start/' . HashHelper::encryptData($id_ujian) . '/' . HashHelper::encryptData($id_paket) . '/' . HashHelper::encryptData($id_fasilitas) . '?page=1');
    }

    public function start($id_uji, $id_pak, $id_fas, $no = null)
    {
        $arr = [];
        $nomor = $no == null ? 1 : $no;

        $id_ujian = HashHelper::decryptData($id_uji);
        $id_paket = HashHelper::decryptData($id_pak);
        $id_fasilitas = HashHelper::decryptData($id_fas);
        $id_user = session('id_pengguna');

        $data['id_user'] = $id_user;
        $data['id_ujian'] = $id_ujian;
        $data['id_paket'] = $id_paket;
        $data['id_fasilitas'] = $id_fasilitas;
        // cek jawaban
        $cekjwb = DB::table('jawabans')->where('id_ujian', $id_ujian)->where('id_paket', $id_paket)->where('no_soal', $nomor)->where('id_user', $id_user)->select('id','no_soal','ragu_ragu','jawaban')->first();

        if ($cekjwb == TRUE) {
            $arr = array(
                'id' => $cekjwb->id,
                'no_soal' => $cekjwb->no_soal,
                'ragu_ragu' => $cekjwb->ragu_ragu,
                'jawaban' => $cekjwb->jawaban
            );
        } else {
            $arr = array(
                'id' => '',
                'no_soal' => '',
                'ragu_ragu' => '',
                'jawaban' => ''
            );
        }

        $data['jawaban'] = $arr;
        $data['soallist'] = Soal::where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->orderBy('no_soal', 'asc')->paginate(24);
        $data['soal'] = Soal::where('no_soal', $nomor)->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->first();

        $data['mulai'] = Mulaiujian::where('id', $id_ujian)->first();


        // jumlah tersisa
        $jumlah = DB::table('soals')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->count();
        $tgl = date('Y-m-d');
        // hitung jawaban
        $jawab = DB::table('jawabans')->where('id_ujian', $id_ujian)->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->where('id_user', $id_user)->where('tgl_ujian', $tgl)->where('jawaban','!=','')->count();

        if ($jumlah < $no) {
            return back();
        } else {
            $data['no'] = $nomor;
        }

        $data['sudahDijawab'] = $jawab;
        $data['belumDijawab'] = $jumlah - $jawab;
        $data['jumlahSoal'] = $jumlah;

        return view('ujian.ujian', $data);
    }

    public function jawaban(Request $r, $id_uji, $id_pak, $id_fas)
    {
        $id_ujian = HashHelper::decryptData($id_uji);
        $id_paket = HashHelper::decryptData($id_pak);
        $id_fasilitas = HashHelper::decryptData($id_fas);

        $id_user = session('id_pengguna');

        $aksi = $r->aksi;
        $no = $r->no;
        $page = $r->page;
        $ragu = $r->jawaban == '' ? '1' : '';

        $tgl_ujian = date('Y-m-d');

        if ($aksi == 'berikutnya') {
            $nomor = $no + 1;

            if ($r->id_jawaban != null) {
                $simpan = Jawaban::where('id', $r->id_jawaban)->update([
                    'no_soal' => $no,
                    'ragu_ragu' => $ragu,
                    // 'jawaban' => $r->jawaban
                ]);
            } else {
                $jawabans = $r->jawaban == '' ? '' : $r->jawaban;
                $double = Jawaban::where('id_paket',$id_paket)->where('id_user',$id_user)->where('id_fasilitas',$id_fasilitas)->where('id_ujian',$id_ujian)->where('no_soal', $no)->first();
                if($double == TRUE){
                    return back();
                }
                $simpan = Jawaban::insert([
                    'id_user' => $id_user,
                    'id_paket' => $id_paket,
                    'id_fasilitas' => $id_fasilitas,
                    'id_ujian' => $id_ujian,
                    'no_soal' => $no,
                    'ragu_ragu' => $ragu,
                    'jawaban' => $jawabans,
                    'tgl_ujian' => date('Y-m-d'),
                    'kategori' => $r->kategori,
                ]);
            }
        } elseif ($aksi == 'sebelumnya') {
            $nomor = $no == 1 ? 2 : ($no + 1);

            $jawaban = $r->jawaban;
            if ($r->id_jawaban != null) {
                $simpan = Jawaban::where('id', $r->id_jawaban)->update([
                    'no_soal' => $no,
                    'ragu_ragu' => $ragu,
                    'jawaban' => $jawaban
                ]);
            } else {
                $validator = Validator::make($r->all(), [
                    'jawaban' => 'required'
                ]);

                if ($validator->fails()) {
                    return back()->with("error", $validator->errors()->first());
                }
                $double = Jawaban::where('id_paket',$id_paket)->where('id_user',$id_user)->where('id_fasilitas',$id_fasilitas)->where('id_ujian',$id_ujian)->where('no_soal', $no)->first();
                if($double == TRUE){
                    return back();
                }
                $simpan = Jawaban::insert([
                    'id_user' => $id_user,
                    'id_paket' => $id_paket,
                    'id_fasilitas' => $id_fasilitas,
                    'id_ujian' => $id_ujian,
                    'no_soal' => $no,
                    'ragu_ragu' => $ragu,
                    'jawaban' => $jawaban,
                    'tgl_ujian' => date('Y-m-d'),
                    'kategori' => $r->kategori,
                ]);
            }
        } elseif ($aksi == 'finish') {
            // cek kategori soal
            $kategoris = [];
            $soalsKategori = DB::table('soals')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->groupBy('kategori')->orderBy('id_soal', 'ASC')->get();
            // $soalsKategori = ['Tes Kompetensi Teknis', 'Tes Manajerial', 'Kemampuan Sosio Kultural', 'Tes Wawancara'];
            foreach ($soalsKategori as $kateg) {
                $kategoris[] = $kateg->kategori;
            }

            // dd($kategoris);

            // cek soal keseluruhan
            $soalsAll = DB::table('soals')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->get();

            // looping semua soal
            $nilai_a = 0;
            $bobot1 = 0;
            $bobot2 = 0;
            $bobot3 = 0;
            $bobot4 = 0;

            $manajer1 = 0;
            $manajer2 = 0;
            $manajer3 = 0;
            $manajer4 = 0;

            $sosio1 = 0;
            $sosio2 = 0;
            $sosio3 = 0;
            $sosio4 = 0;
            $sosio5 = 0;

            $wawancara1 = 0;
            $wawancara2 = 0;
            $wawancara3 = 0;
            $wawancara4 = 0;

            $tglUjian = date('Y-m-d');

            foreach ($soalsAll as $i => $soalAll) {
                // cek nilai yang di jawab user
                $jawabanAll = DB::table('jawabans')
                ->where('id_ujian', $id_ujian)
                ->where('id_paket', $id_paket)
                ->where('id_fasilitas', $id_fasilitas)
                ->where('id_user', $id_user)
                ->where('no_soal', $soalAll->no_soal)
                ->where('tgl_ujian', $tglUjian)
                ->where('jawaban','!=', '')
                ->select('jawaban as jawab')
                ->first();
                if ($jawabanAll == TRUE) {
                    // cek jawaban masuk kategori mana
                    if ($kategoris[0] == $soalAll->kategori) {
                        if (isset($soalAll->{'jawaban_' . $jawabanAll->jawab})) {
                            if ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} != 0) {
                                $bobot1 += 5;
                                $nilai_a += 1;
                            }
                        }
                    } elseif ($kategoris[1] == $soalAll->kategori) {
                        if ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} != 0) {
                            if ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 1) {
                                $bobot2 += 1;
                                $manajer1 = $manajer1 + 1;
                            } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 2) {
                                $bobot2 += 2;
                                $manajer2 = $manajer2 + 1;
                            } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 3) {
                                $bobot2 += 3;
                                $manajer3 = $manajer3 + 1;
                            } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 4) {
                                $bobot2 += 4;
                                $manajer4 = $manajer4 + 1;
                            }
                        }
                    } elseif ($kategoris[2] == $soalAll->kategori) {
                        if ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} != 0) {
                            if ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 1) {
                                $bobot3 += 1;
                                $sosio1 = $sosio1 + 1;
                            } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 2) {
                                $bobot3 += 2;
                                $sosio2 = $sosio2 + 1;
                            } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 3) {
                                $bobot3 += 3;
                                $sosio3 = $sosio3 + 1;
                            } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 4) {
                                $bobot3 += 4;
                                $sosio4 = $sosio4 + 1;
                            } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 5) {
                                $bobot3 += 5;
                                $sosio5 = $sosio5 + 1;
                            }
                        }
                    } elseif ($kategoris[3] == $soalAll->kategori) {
                        if ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} != 0) {
                            if ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 1) {
                                $bobot4 += 1;
                                $wawancara1 = $wawancara1 + 1;
                            } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 2) {
                                $bobot4 += 2;
                                $wawancara2 = $wawancara2 + 1;
                            } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 3) {
                                $bobot4 += 3;
                                $wawancara3 = $wawancara3 + 1;
                            } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 4) {
                                $bobot4 += 4;
                                $wawancara4 = $wawancara4 + 1;
                            }
                        }
                    }
                }
            }

            $nilai_b = $manajer1 . "," . $manajer2 . "," . $manajer3 . "," . $manajer4;
            $nilai_c = $sosio1 . "," . $sosio2 . "," . $sosio3 . "," . $sosio4 . "," . $sosio5;
            $nilai_d = $wawancara1 . "," . $wawancara2 . "," . $wawancara3 . "," . $wawancara4;

            DB::table('hasilujians')->insert([
                'id_ujian' => $id_ujian,
                'id_paket' => $id_paket,
                'id_fasilitas' => $id_fasilitas,
                'id_user' => $id_user,
                'nilai_a' => $nilai_a,
                'nilai_b' => $nilai_b,
                'nilai_c' => $nilai_c,
                'nilai_d' => $nilai_d,
                'bobot_a' => $bobot1,
                'bobot_b' => $bobot2,
                'bobot_c' => $bobot3,
                'bobot_d' => $bobot4,
                'tgl_ujian' => $tgl_ujian
            ]);

            return redirect('hasil/try-out')->with('pesan', 'Ujian Berakhir');
        }

        $totalSoal = DB::table('soals')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->count();

        if ($nomor >= 145) {
            $page = 7;
        } elseif ($nomor > 144) {
            $page = 7;
        } elseif ($nomor > 120) {
            $page = 6;
        } elseif ($nomor > 96) {
            $page = 5;
        } elseif ($nomor > 72) {
            $page = 4;
        } elseif ($nomor > 48) {
            $page = 3;
        } elseif ($nomor > 24) {
            $page = 2;
        } else {
            $page = 1;
        }

        return redirect('ujian/start/' . HashHelper::encryptData($id_ujian) . '/' . HashHelper::encryptData($id_paket) . '/' . HashHelper::encryptData($id_fasilitas) . '/' . $nomor . '?page=' . $page);
    }

    public function finish(Request $r, $id_user, $id_pak, $id_uji, $id_fas)
    {
        $tgl_ujian = date('Y-m-d');
        $id_ujian = HashHelper::decryptData($id_uji);
        $id_paket = HashHelper::decryptData($id_pak);
        $id_fasilitas = HashHelper::decryptData($id_fas);
        // cek kategori soal
        $kategoris = [];
        $soalsKategori = DB::table('soals')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->groupBy('kategori')->orderBy('id_soal', 'ASC')->get();
        // $soalsKategori = ['Tes Kompetensi Teknis', 'Tes Manajerial', 'Kemampuan Sosio Kultural', 'Tes Wawancara'];
        foreach ($soalsKategori as $kateg) {
            $kategoris[] = $kateg->kategori;
        }

        // cek soal keseluruhan
        $soalsAll = DB::table('soals')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->get();

        // looping semua soal
        $nilai_a = 0;
        $bobot1 = 0;
        $bobot2 = 0;
        $bobot3 = 0;
        $bobot4 = 0;

        $manajer1 = 0;
        $manajer2 = 0;
        $manajer3 = 0;
        $manajer4 = 0;

        $sosio1 = 0;
        $sosio2 = 0;
        $sosio3 = 0;
        $sosio4 = 0;
        $sosio5 = 0;

        $wawancara1 = 0;
        $wawancara2 = 0;
        $wawancara3 = 0;
        $wawancara4 = 0;

        $tglUjian = date('Y-m-d');

        foreach ($soalsAll as $i => $soalAll) {
            // cek nilai yang di jawab user
            $jawabanAll = DB::table('jawabans')
            ->where('id_ujian', $id_ujian)
            ->where('id_paket', $id_paket)
            ->where('id_fasilitas', $id_fasilitas)
            ->where('id_user', $id_user)
            ->where('no_soal', $soalAll->no_soal)
            ->where('tgl_ujian', $tglUjian)
            ->where('jawaban','!=', '')
            ->select('jawaban as jawab')
            ->first();
            if ($jawabanAll == TRUE) {
                if ($kategoris[0] == $soalAll->kategori) {
                    if ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} != 0) {
                        $bobot1 += 5;
                        $nilai_a += 1;
                    }
                } elseif ($kategoris[1] == $soalAll->kategori) {
                    if ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 1) {
                        $bobot2 += 1;
                        $manajer1 = $manajer1 + 1;
                    } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 2) {
                        $bobot2 += 2;
                        $manajer2 = $manajer2 + 1;
                    } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 3) {
                        $bobot2 += 3;
                        $manajer3 = $manajer3 + 1;
                    } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 4) {
                        $bobot2 += 4;
                        $manajer4 = $manajer4 + 1;
                    }
                } elseif ($kategoris[2] == $soalAll->kategori) {
                    if ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 1) {
                        $bobot3 += 1;
                        $sosio1 = $sosio1 + 1;
                    } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 2) {
                        $bobot3 += 2;
                        $sosio2 = $sosio2 + 1;
                    } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 3) {
                        $bobot3 += 3;
                        $sosio3 = $sosio3 + 1;
                    } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 4) {
                        $bobot3 += 4;
                        $sosio4 = $sosio4 + 1;
                    } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 5) {
                        $bobot3 += 5;
                        $sosio5 = $sosio5 + 1;
                    }
                } elseif ($kategoris[3] == $soalAll->kategori) {
                    if ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 1) {
                        $bobot4 += 1;
                        $wawancara1 = $wawancara1 + 1;
                    } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 2) {
                        $bobot4 += 2;
                        $wawancara2 = $wawancara2 + 1;
                    } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 3) {
                        $bobot4 += 3;
                        $wawancara3 = $wawancara3 + 1;
                    } elseif ((int)$soalAll->{'jawaban_' . $jawabanAll->jawab} == 4) {
                        $bobot4 += 4;
                        $wawancara4 = $wawancara4 + 1;
                    }
                }
            }
        }

        $nilai_b = $manajer1 . "," . $manajer2 . "," . $manajer3 . "," . $manajer4;
        $nilai_c = $sosio1 . "," . $sosio2 . "," . $sosio3 . "," . $sosio4 . "," . $sosio5;
        $nilai_d = $wawancara1 . "," . $wawancara2 . "," . $wawancara3 . "," . $wawancara4;

        DB::table('hasilujians')->insert([
            'id_ujian' => $id_ujian,
            'id_paket' => $id_paket,
            'id_fasilitas' => $id_fasilitas,
            'id_user' => $id_user,
            'nilai_a' => $nilai_a,
            'nilai_b' => $nilai_b,
            'nilai_c' => $nilai_c,
            'nilai_d' => $nilai_d,
            'bobot_a' => $bobot1,
            'bobot_b' => $bobot2,
            'bobot_c' => $bobot3,
            'bobot_d' => $bobot4,
            'tgl_ujian' => $tgl_ujian
        ]);

        return redirect('hasil/try-out')->with('pesan', 'Ujian Berakhir');
    }

    public function grafikujian($id_ujian, $id_fasilitas, $id_paket)
    {
        $id_user = session('id_pengguna');
        $kategoris = [];
        $data['no'] = 0;

        $tglUjian = date('Y-m-d');

        // ambil semua kategori
        $soalsKategori = DB::table('soals')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->groupBy('kategori')->orderBy('id_soal', 'ASC')->get();
        // $soalsKategori = ['Tes Kompetensi Teknis', 'Tes Manajerial', 'Kemampuan Sosio Kultural', 'Tes Wawancara'];
        foreach ($soalsKategori as $kateg) {
            $kategoris[] = $kateg->kategori;
        }
        // hitung soal keseluruhan
        $soalsAllhitung = DB::table('soals')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->where('kategori', $kategoris[0])->count();

        // hitung jumlah soal berdasar kategori
        $soalsKategorihitung = DB::table('soals')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->where('kategori', 'Tes Kompetensi Teknis')->count();

        // hitung jumlah soal yang dijawab
        $soalDijawab = DB::table('jawabans')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->where('id_ujian', $id_ujian)->where('id_user', $id_user)->where('jawaban', '!=', '')->where('kategori',$kategoris[0])->count();

        // hitung jumlah soal yang dijawab berdasarkan kategori
        $soalDijawabKategori = DB::table('jawabans')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->where('id_ujian', $id_ujian)->where('id_user', $id_user)->where('jawaban', '!=', '')->where('kategori', $kategoris[0])->count();

        // ambil total jawaban benar
        $benarjawaban = DB::table('hasilujians')->where('id_ujian', $id_ujian)->where('id_paket', $id_paket)->where('id_user', session('id_pengguna'))->select('bobot_a', 'nilai_a', 'bobot_b', 'nilai_b', 'bobot_c', 'nilai_c', 'bobot_d', 'nilai_d')->first();
        $kosong = $soalsAllhitung - $soalDijawab;
        $salah = $soalDijawab - $benarjawaban->nilai_a;

        $nilai = DB::table('hasilujians')->where('id_ujian', $id_ujian)->where('id_ujian', $id_ujian)->where('id_paket', $id_paket)->where('id_user', session('id_pengguna'))->first();

        $arr = array(
            'manajer' => $nilai->nilai_b,
            'sosio' => $nilai->nilai_c,
            'wawancara' => $nilai->nilai_d
        );

        $data['grafik'] = $arr;
        $data['benar'] = $nilai->nilai_a;
        $data['kosong'] = $kosong;
        $data['salah'] = $salah;
        $data['kategori'] = $kategoris;
        $data['jawabanbenar'] = $benarjawaban;
        return view('ujian/hasilujian', $data);
    }

    public function reviewujian($id_ujian, $id_fasilitas, $id_paket, $no = null)
    {
        $nomor = $no == null ? 1 : $no;
        $data['no'] = $nomor;
        $data['jumlahSoal'] = 0;
        $data['sudahDijawab'] = 0;
        $data['belumDijawab'] = 0;
        $data['id_ujian'] = $id_ujian;
        $data['id_paket'] = $id_paket;
        $data['id_fasilitas'] = $id_fasilitas;

        // ambil semua kategori
        $soalsKategori = DB::table('soals')->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->select('kategori')->groupBy('kategori')->orderBy('id_soal', 'ASC')->get();

        // $soalsKategori = ['Tes Kompetensi Teknis', 'Tes Manajerial', 'Kemampuan Sosio Kultural', 'Tes Wawancara'];
        foreach ($soalsKategori as $kateg) {
            $kategoris[] = $kateg->kategori;
        }

        $jawabananda = DB::table('jawabans')->where('id_ujian', $id_ujian)->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->where('id_user', session('id_pengguna'))->where('no_soal', $nomor)->first();

        $data['soal'] = Soal::where('no_soal', $nomor)->where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->first();

        if ($jawabananda == TRUE) {
            if (trim($kategoris[0]) == $jawabananda->kategori) {
                if ($jawabananda->jawaban != null) {
                    if ($data['soal']->{'jawaban_' . $jawabananda->jawaban} == 5) {
                        $data['jawaban'] = 1;
                    } else {
                        $data['jawaban'] = 2;
                    }
                } else {
                    $data['jawaban'] = 0;
                }
            } elseif (trim($kategoris[1]) == $jawabananda->kategori) {
                if ($jawabananda->jawaban != null) {
                    if ($data['soal']->{'jawaban_' . $jawabananda->jawaban} == 4) {
                        $data['jawaban'] = 1;
                    } else {
                        $data['jawaban'] = 2;
                    }
                } else {
                    $data['jawaban'] = 0;
                }
            } elseif (trim($kategoris[2]) == $jawabananda->kategori) {
                if ($jawabananda->jawaban != null) {
                    if ($data['soal']->{'jawaban_' . $jawabananda->jawaban} == 5) {
                        $data['jawaban'] = 1;
                    } else {
                        $data['jawaban'] = 2;
                    }
                } else {
                    $data['jawaban'] = 0;
                }
            } elseif (trim($kategoris[3]) == $jawabananda->kategori) {
                if ($jawabananda->jawaban != null) {
                    if ($data['soal']->{'jawaban_' . $jawabananda->jawaban} == 4) {
                        $data['jawaban'] = 1;
                    } else {
                        $data['jawaban'] = 2;
                    }
                } else {
                    $data['jawaban'] = 0;
                }
            }
        } else {
            $data['jawaban'] = 0;
        }

        $data['soallist'] = Soal::where('id_paket', $id_paket)->where('id_fasilitas', $id_fasilitas)->orderBy('no_soal', 'asc')->get();

        $data['kategori'] = $kategoris;
        return view('ujian/reviewujian', $data);
    }
}
