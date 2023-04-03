<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skorsoal extends Model
{
    use HasFactory;
    protected $table = "skorsoals";
    protected $fillable = ['id_paket', 'id_fasilitas', 'teknis', 'manajer', 'sosio', 'wawancara'];
}
