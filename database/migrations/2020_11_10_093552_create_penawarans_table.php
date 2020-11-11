<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenawaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penawarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penawaran')->unique();
            $table->foreignId('id_kebutuhan')->nullable()->constrained('kebutuhans')->onDelete('set null');
            $table->foreignId('id_mangga')->nullable()->constrained('manggas')->onDelete('set null');
            $table->foreignId('id_kelompok')->nullable()->constrained('kelompok_tanis')->onDelete('set null');
            $table->foreignId('id_retailer')->nullable()->constrained('retailers')->onDelete('set null');
            $table->enum('role',['kelompok','retailer']);
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
        Schema::dropIfExists('penawarans');
    }
}
