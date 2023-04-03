<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    protected $table = "soals";
    protected $primaryKey = 'id';
    protected $fillable = ['id_paket', 'id_tryout', 'id_fasilitas', 'waktu', 'no_soal', 'gambar', 'soal', 'a', 'b', 'c', 'd', 'e', 'jawaban_a', 'jawaban_b', 'jawaban_c', 'jawaban_d', 'jawaban_e', 'pembahasan', 'pembahasan_gambar', 'jawaban_terbaik', 'level', 'deskripsi', 'indikator', 'kategori'];
}
