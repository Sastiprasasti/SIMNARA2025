<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('admin_document_path')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('admin_document_path');
        });
    }
};
