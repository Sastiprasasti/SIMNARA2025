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
        Schema::table('submissions', function (Blueprint $table) {
            $table->text('menimbang')->nullable()->change();
            $table->json('kepada')->nullable()->change();
            $table->text('untuk')->nullable()->change();
            $table->string('jangka_waktu')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->text('menimbang')->nullable(false)->change();
            $table->json('kepada')->nullable(false)->change();
            $table->text('untuk')->nullable(false)->change();
            $table->string('jangka_waktu')->nullable(false)->change();
        });
    }
};
