<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reportsoal extends Model
{
    use HasFactory;
    protected $table = "reportsoals";
    protected $fillable = ['id_paket', 'id_fasilitas', 'id_soal', 'kategori_laporan', 'laporan', 'tgl_lapor'];

    public function paket(){
        return $this->hasOne(Paket::class,'id','id_paket');
    }
    public function fasilitas(){
        return $this->hasOne(Fasilitas::class,'id','id_fasilitas');
    }
    public function soal(){
        return $this->hasOne(Soal::class,'id_soal','id_soal');
    }
}
