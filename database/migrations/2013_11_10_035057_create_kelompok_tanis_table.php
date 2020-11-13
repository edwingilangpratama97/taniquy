<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelompokTanisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelompok_tanis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kelompok')->unique();
            $table->foreignId('id_desa')->nullable()->constrained('desas')->onDelete('set null');
            $table->string('nama', 100)->nullable();
            $table->string('ketua', 100)->nullable();
            $table->string('kontak', 20)->nullable();
            $table->text('foto_ketua')->nullable();
            $table->text('alamat')->nullable();
            $table->string('latitude', 100)->nullable();
            $table->string('longitude', 100)->nullable();
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
        Schema::dropIfExists('kelompok_tanis');
    }
}
