<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->bigIncrements('id_penjualan');
            $table->unsignedBigInteger('id_pelanggan')->nullable();
            $table->string('nama_pembeli')->nullable();
            $table->date('tgl_penjualan');
            $table->decimal('total_harga', 10,2);
            $table->decimal('uang_bayar', 10,2);
            $table->decimal('kembali', 10,2);
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
        Schema::dropIfExists('penjualans');
    }
}
