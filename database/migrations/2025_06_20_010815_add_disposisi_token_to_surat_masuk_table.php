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
        Schema::table('surat_masuk', function (Blueprint $table) {
            if (!Schema::hasColumn('surat_masuk', 'disposisi_token')) {
                $table->uuid('disposisi_token')->nullable()->after('perihal');
            }

            if (!Schema::hasColumn('surat_masuk', 'status_disposisi')) {
                $table->string('status_disposisi')->default('Menunggu')->after('disposisi_token');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            //
        });
    }
};
