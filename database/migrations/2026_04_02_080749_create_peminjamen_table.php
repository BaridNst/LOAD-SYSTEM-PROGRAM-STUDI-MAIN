<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users (otomatis mencari tabel 'users')
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Relasi ke tabel barang (dikunci manual ke 'barang' agar tidak mencari 'barangs')
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            
            $table->integer('jumlah');
            $table->timestamp('tanggal_pinjam');
            $table->timestamp('tanggal_kembali')->nullable();
            $table->string('status'); // Contoh: 'dipinjam', 'dikembalikan'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};