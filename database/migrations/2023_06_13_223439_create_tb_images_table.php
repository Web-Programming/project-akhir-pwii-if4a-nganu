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
        Schema::create('tb_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('tipe');
            $table->string('path');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();
    
            $table->foreign('id_user')->references('id')->on('users');
        });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_images', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
        });
    
        Schema::dropIfExists('tb_images');
        }
};
