<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pemesanan')->unique();
            $table->foreignId('id_postingan')->nullable()->constrained('postingans')->onDelete('set null');
            $table->foreignId('id_enduser')->nullable()->constrained('endusers')->onDelete('set null');
            $table->foreignId('id_retailer')->nullable()->constrained('retailers')->onDelete('set null');
            $table->boolean('status_pembayaran')->default(0); // Apakah Pembeli sudah bayar? di approve penjual
            $table->boolean('status_penerimaan')->default(0); // Apakah Barang sudah diterima? di approve pembeli
            // $table->enum('role',['enduser','retailer']);
            $table->integer('jumlah');
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
        Schema::dropIfExists('pemesanans');
    }
}
