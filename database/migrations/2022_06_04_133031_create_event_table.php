<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string("banner");
            $table->string("nama_event");
            $table->string("kategori");
            $table->string("pembuat_event");
            $table->dateTime("tanggal_mulai");
            $table->dateTime("tanggal_berakhir");
            $table->text("deskripsi");
            $table->string("lokasi");
            $table->date('deadline_pendaftaran');
            $table->integer('kuota');
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
        Schema::dropIfExists('event');
    }
}
