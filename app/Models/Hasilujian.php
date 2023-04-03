<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasilujian extends Model
{
    use HasFactory;
    protected $table = "hasilujians";
    protected $fillable = ['id_mulaiujian', 'id_paket', 'id_user', 'nilai_a', 'nilai_b', 'nilai_c', 'nilai_d', 'bobot_a', 'bobot_b', 'bobot_c', 'bobot_d', 'tgl_ujian'];
}
