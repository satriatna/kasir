<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasokBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasok_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasok_id')->references('id')->on('pasok')->onDelete('cascade');
            $table->foreignId('buku_id')->references('id')->on('buku')->onDelete('cascade');
            $table->string('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasok_barang');
    }
}
