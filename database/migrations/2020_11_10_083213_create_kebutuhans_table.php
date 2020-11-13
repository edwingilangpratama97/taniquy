<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKebutuhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kebutuhans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kebutuhan')->unique();
            $table->foreignId('id_enduser')->nullable()->constrained('endusers')->onDelete('set null');
            $table->foreignId('id_retailer')->nullable()->constrained('retailers')->onDelete('set null');
            // $table->enum('role',['enduser','retailer']);
            $table->foreignId('id_jenis')->nullable()->constrained('jenis_manggas')->onDelete('set null');
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
        Schema::dropIfExists('kebutuhans');
    }
}
