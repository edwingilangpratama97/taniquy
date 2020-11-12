<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endusers', function (Blueprint $table) {
            $table->id();
            $table->string('kode_enduser')->unique();
            $table->foreignId('id_desa')->nullable()->constrained('desas')->onDelete('set null');
            $table->string('nama', 100);
            $table->string('foto')->nullable();
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['L','P']);
            $table->string('kontak', 20);
            $table->text('alamat');
            $table->string('latitude', 100);
            $table->string('longitude', 100);
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
        Schema::dropIfExists('endusers');
    }
}
