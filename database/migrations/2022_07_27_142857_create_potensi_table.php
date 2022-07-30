<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potensi', function (Blueprint $table) {
            $table->id();
            $table->string('judul_potensi');
            $table->string('slug')->unique();
            $table->longText('konten');
            $table->string('gambar')->nullable();
            $table->timestamps();
            $table->string('penulis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('potensi');
    }
};
