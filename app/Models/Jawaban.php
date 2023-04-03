<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    protected $table = "jawabans";
    protected $fillable = ['id_user', 'id_paket', 'id_ujian', 'no_soal', 'ragu_ragu', 'jawaban', 'tgl_ujian'];
}
