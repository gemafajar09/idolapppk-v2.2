<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianTmp extends Model
{
    use HasFactory;
    protected $table = "pembelian_tmps";
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pengguna','id_paket','harga','masa_aktif','harga_coret'
    ];

    public function paket(){
        return $this->belongsTo(Paket::class,'id_paket');
    }
}
