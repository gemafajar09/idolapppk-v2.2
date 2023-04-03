<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPaket extends Model
{
    use HasFactory;

    protected $table = 'kategori_pakets';
    protected $fillable = ['nama', 'type', 'banner'];
}
