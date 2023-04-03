<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriBonus extends Model
{
    use HasFactory;
    protected $table = "histori_bonuses";
    protected $fillable = ['id_pengguna','kode_referal','bonus_afiliasi','tanggal_bonus'];
}
