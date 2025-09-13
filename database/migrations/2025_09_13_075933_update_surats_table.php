<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            // Hapus kolom 'kategori' yang lama
            $table->dropColumn('kategori');

            // Tambahkan kolom 'kategori_id' yang baru
            $table->unsignedBigInteger('kategori_id')->after('nomor_surat');

            // Tambahkan foreign key constraint
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            // Hapus foreign key dan kolom baru
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');

            // Tambahkan kembali kolom 'kategori' yang lama (untuk rollback)
            $table->string('kategori');
        });
    }
};
