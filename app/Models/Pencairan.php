<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pencairan extends Model
{
    use HasFactory;
    protected $table = "pencairans";
    protected $primaryKey = 'id';
    protected $fillable = [
        'secret_kode','id_pengguna','informasi_bank','nama_penerima','no_rekening','saldo_komisi','tanggal_pencairan','status_pencairan'
    ];
    public function pengguna(){
        return $this->belongsTo(Pengguna::class,'id_pengguna');
    }
}
