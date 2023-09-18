<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tutor_id");
            // $table->foreignId("silabus_id")->nullable();
            $table->string("banner");
            $table->string("nama_kelas");
            $table->date("pendaftaran_buka");
            $table->date("pendaftaran_tutup");
            $table->date("tanggal_mulai");
            $table->date("tanggal_berakhir");
            $table->text("persyaratan");
            $table->text("deskripsi");
            $table->string("status");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
