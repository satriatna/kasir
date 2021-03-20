<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjualan_id')->nullable()->references('id')->on('penjualan')->onDelete('cascade')->constrained();
            $table->foreignId('buku_id')->references('id')->on('buku')->onDelete('cascade');
            $table->string('jumlah');
            $table->string('total');
            $table->string('disc')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('penjualan_barang');
    }
}
