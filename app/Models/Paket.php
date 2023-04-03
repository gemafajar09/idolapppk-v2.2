<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, 'id_paket');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriPaket::class, 'id_kategori_paket', 'id');
    }
}
