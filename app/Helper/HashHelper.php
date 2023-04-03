<?php

namespace App\Helper;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class HashHelper
{
    public static function encryptData($id)
    {
        $id_baru = Crypt::encryptString($id);
        return $id_baru;
    }
    public static function decryptData($id)
    {
        try {
            return $id_baru = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return false;
        }
    }
    public static function encryptArray($data)
    {
        $result = Crypt::encrypt($data);
        return $result;
    }

    public static function decryptArray($data)
    {
        try {
            return $result = Crypt::decrypt($data);
        } catch (DecryptException $e) {
            return false;
        }
    }

    public static function tglIndo($tanggal)
    {
        $bulan = array(
            1 =>       'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $var = explode('-', $tanggal);

        return $var[2] . ' ' . $bulan[(int)$var[1]] . ' ' . $var[0];
    }

    public static function bulantahun($tgl)
    {
        $nama_bulan = array(
            1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
            "September", "Oktober", "November", "Desember"
        );
        $tahun = substr($tgl, 0, 4);
        $bulan = $nama_bulan[(int)substr($tgl, 5, 2)];
        $text = "";

        $text .= $bulan ." ". $tahun;
        return $text;
    }

    public static function tanggal_indonesia($tgl, $tampil_hari=true){
        $nama_hari=array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
        $nama_bulan = array (
                1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                "September", "Oktober", "November", "Desember");
        $tahun=substr($tgl,0,4);
        $bulan=$nama_bulan[(int)substr($tgl,5,2)];
        $tanggal=substr($tgl,8,2);
        $text="";
        if ($tampil_hari) {
            $urutan_hari=date('w', mktime(0,0,0, substr($tgl,5,2), $tanggal, $tahun));
            $hari=$nama_hari[$urutan_hari];
            $text .= $hari.", ";
        }
            $text .=$tanggal ." ". $bulan ." ". $tahun;
        return $text;
    }
}


