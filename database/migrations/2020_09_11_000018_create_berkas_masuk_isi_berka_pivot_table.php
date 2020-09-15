<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasMasukIsiBerkaPivotTable extends Migration
{
    public function up()
    {
        Schema::create('berkas_masuk_isi_berka', function (Blueprint $table) {
            $table->unsignedInteger('berkas_masuk_id');
            $table->foreign('berkas_masuk_id', 'berkas_masuk_id_fk_2165289')->references('id')->on('berkas_masuks')->onDelete('cascade');
            $table->unsignedInteger('isi_berka_id');
            $table->foreign('isi_berka_id', 'isi_berka_id_fk_2165289')->references('id')->on('isi_berkas')->onDelete('cascade');
        });
    }
}
