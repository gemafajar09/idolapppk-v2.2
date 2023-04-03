<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = "pembelians";
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_pembelian', 'id_pengguna', 'kode_referal', 'total', 'potong_harga', 'total_bayar', 'potong_komisi', 'bank', 'status_pembelian', 'tanggal_pembelian', 'tanggal_aktifasi', 'bukti_bayar', 'snap_token'
    ];

    public function detail()
    {
        return $this->hasMany(PembelianDetail::class, 'kode_pembelian', 'kode_pembelian');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
}
