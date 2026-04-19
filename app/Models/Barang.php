<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // WAJIB ADA: Karena di HeidiSQL nama tabelnya 'barang' (tunggal)
    protected $table = 'barang'; 

    public $timestamps = false;

    protected $fillable = [
        'nama_barang',
        'stok',
        'lokasi',
    ];
}