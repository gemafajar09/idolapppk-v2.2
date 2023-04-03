<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory;
    protected $table = "pembelian_details";
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_pembelian', 'id_pengguna', 'id_paket', 'harga', 'masa_aktif', 'status_pembelian', 'tanggal_pembelian', 'tanggal_aktifasi', 'status_pembelian'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }
}
