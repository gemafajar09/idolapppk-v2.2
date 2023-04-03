<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasisoal extends Model
{
    use HasFactory;
    protected $table = "informasisoals";
    protected $fillable = ['id_paket', 'id_fasilitas', 'informasi'];
}
