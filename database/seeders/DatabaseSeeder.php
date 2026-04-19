<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil BarangSeeder agar data barang masuk ke database
        $this->call([
            BarangSeeder::class,
        ]);

        // Membuat user untuk login
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Tambahkan password agar bisa login
        ]);
    }
}