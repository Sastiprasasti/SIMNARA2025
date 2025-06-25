<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->string('status_disposisi')->default('Menunggu'); // Menunggu | Disetujui | Ditolak
            $table->string('disposisi_token')->nullable(); // token unik untuk verifikasi link
        });
    }

    public function down()
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->dropColumn(['status_disposisi', 'disposisi_token']);
        });
    }
};
