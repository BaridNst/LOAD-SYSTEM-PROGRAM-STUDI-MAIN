<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangs = [
            ['nama_barang' => 'Infocus', 'stok' => 5],
            ['nama_barang' => 'Kabel LAN', 'stok' => 20],
            ['nama_barang' => 'Wayer', 'stok' => 10],
            ['nama_barang' => 'Lab Komputer', 'stok' => 1],
            ['nama_barang' => 'Lab Jaringan', 'stok' => 1],
            ['nama_barang' => 'Mikrotik', 'stok' => 10],
        ];

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}