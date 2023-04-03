<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = "materis";
    protected $fillable = ['id_paket', 'materi','id_kategori_materi'];

    public function kategorimateri(){
        return $this->hasOne(KategoriMateri::class,'id','id_kategori_materi');
    }
}
