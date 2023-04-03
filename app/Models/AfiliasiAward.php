<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AfiliasiAward extends Model
{
    use HasFactory;

    protected $table = 'afiliasi_awards';
    protected $primaryKey = 'id';
    protected $fillable = 
    [
        'id_pengguna', 
        'secret_code_award', 
        'point_award',
        'informasi_bank', 
        'nama_penerima', 
        'no_rekening', 
        'saldo_komisi_award', 
        'tanggal_award', 
        'status_award'
    ];
    public function pengguna(){
        return $this->belongsTo(Pengguna::class,'id_pengguna');
    }
}