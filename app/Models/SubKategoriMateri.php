<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategoriMateri extends Model
{
    use HasFactory;
    public function kategori(){
        return $this->belongsTo(KategoriMateri::class,'id_kategori_materi','id');
    }
}
