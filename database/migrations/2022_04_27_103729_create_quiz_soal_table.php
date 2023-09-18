<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_soal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id');
            $table->text("soal");
            $table->string('a');
            $table->string('b');
            $table->string('c');
            $table->string('d');
            $table->enum('kunci_jawaban', ['A', 'B', 'C', 'D']);
            $table->string('pembahasan')->nullable();
            $table->string('file')->nullable();
            $table->enum('aktif', ['Y', 'N']);
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
        Schema::dropIfExists('quiz_soal');
    }
}
