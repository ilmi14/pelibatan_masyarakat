<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas_kategori', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id');
            $table->boolean('TK_PAUD')->default('0');
            $table->boolean('SD_MI')->default('0');
            $table->boolean('SMP_MTS')->default('0');
            $table->boolean('SMA_SMK_MA')->default('0');
            $table->boolean('Mahasiswa')->default('0');
            $table->boolean('Masyarakat_Umum')->default('0');
            $table->boolean('ASN_Polri_TNI')->default('0');
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
        Schema::dropIfExists('kelas_kategori');
    }
}
