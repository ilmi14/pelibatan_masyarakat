<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrasiEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasi_event', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->foreignId("event_id");
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
        Schema::dropIfExists('registrasi_event');
    }
}
