<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('nama');
            $table->text('alamat');
            $table->text('tujuan'); 
            $table->text('menimbang')->nullable(); // Boleh kosong
            $table->json('kepada')->nullable(); // Boleh kosong
            $table->text('untuk')->nullable(); // Boleh kosong
            $table->string('jangka_waktu')->nullable(); // Boleh kosong
            $table->enum('jenis_form', ['form1', 'form2', 'form3']);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_remarks')->nullable();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
};