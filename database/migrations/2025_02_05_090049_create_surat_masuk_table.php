<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/[timestamp]_create_surat_masuk_table.php
public function up()
{
    Schema::create('surat_masuk', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_surat');
        $table->date('tanggal');
        $table->string('nama_pengirim');
        $table->text('tujuan');
        $table->string('file_path')->nullable(); // untuk PDF
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};
