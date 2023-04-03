<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hash;
class Pengguna extends Model
{
    use HasFactory;
    protected $table = "penggunas";
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nama','email','password','password_confirmation','kode_afiliasi','no_telpon','informasi_bank','saldo_afiliasi','id_provinsi','id_kota','iklan_idolapppk','status_user','afiliasi_awards'
    ];

    public function CheckLoginUser($email, $password)
    {
        $data_user = $this->where("email", $email)->get();
        // dd(count($data_user) == 1);
        if (count($data_user) == 1) {
            if (Hash::check($password, $data_user[0]->password)) {
                unset($data_user[0]->password);
                return $data_user[0];
            }
        }
        return false;
    }

    public function provinsi(){
        return $this->hasOne(Provinsi::class,'id_provinsi','id_provinsi');
    }
    public function kota(){
        return $this->hasOne(Kota::class,'id_kota','id_kota');
    }
}
