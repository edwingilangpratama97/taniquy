<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postingans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_postingan')->unique();
            $table->foreignId('id_mangga')->nullable()->constrained('manggas')->onDelete('set null');
            $table->foreignId('id_kelompok')->nullable()->constrained('kelompok_tanis')->onDelete('set null');
            $table->foreignId('id_retailer')->nullable()->constrained('retailers')->onDelete('set null');
            // $table->enum('role',['kelompok','retailer']);
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('postingans');
    }
}
