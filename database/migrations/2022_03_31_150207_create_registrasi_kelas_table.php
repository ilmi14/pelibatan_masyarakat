<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrasiKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasi_kelas', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId("user_id");
            $table->foreignId("kelas_id");
            $table->text("motivasi");
            $table->string("status")->nullable();
            $table->text("catatan")->nullable();
            $table->enum("sertifikat", ['Terbit', 'Tidak Terbit'])->nullable();
            $table->text("catatan_sertifikat")->nullable();
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
        Schema::dropIfExists('registrasi_kelas');
    }
}
