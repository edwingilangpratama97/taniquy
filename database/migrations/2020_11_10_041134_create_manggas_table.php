<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManggasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manggas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kelompok')->nullable()->constrained('kelompok_tanis')->onDelete('set null');
            $table->foreignId('id_retailer')->nullable()->constrained('retailers')->onDelete('set null');
            // $table->enum('role',['kelompok','retailer'])->nullable();
            $table->foreignId('id_jenis')->nullable()->constrained('jenis_manggas')->onDelete('set null');
            $table->foreignId('id_grade')->nullable()->constrained('grades')->onDelete('set null');
            $table->string('kode_mangga')->unique();
            $table->text('foto')->nullable();
            $table->integer('harga');
            $table->integer('stok');
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
        Schema::dropIfExists('manggas');
    }
}
