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
    Schema::table('barangs', function (Blueprint $table) {
        // Menambahkan kolom nama_tempat setelah nama_barang
        $table->string('nama_tempat')->default('Ruangan Program Studi')->after('nama_barang');
    });
}

public function down(): void
{
    Schema::table('barangs', function (Blueprint $table) {
        $table->dropColumn('nama_tempat');
    });
}
};

