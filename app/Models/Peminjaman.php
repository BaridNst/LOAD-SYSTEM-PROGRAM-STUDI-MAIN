<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamen';

    protected $fillable = [
        'user_id', 
        'barang_id', 
        'jumlah', 
        'tanggal_pinjam', 
        'status'
    ];

    // Relasi ke User (Siapa yang pinjam)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Barang (Barang apa yang dipinjam)
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}