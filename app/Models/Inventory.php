<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    // Ini bagian terpenting agar tidak error "Table not found"
    protected $table = 'barang'; 

    protected $fillable = ['nama_barang', 'lokasi', 'stok'];
}