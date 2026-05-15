<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_hewan',
        'jenis',
        'umur',
        'harga',
        'deskripsi',
        'gambar'
    ];
}
