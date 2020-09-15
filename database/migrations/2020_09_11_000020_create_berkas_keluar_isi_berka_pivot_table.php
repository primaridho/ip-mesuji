<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasKeluarIsiBerkaPivotTable extends Migration
{
    public function up()
    {
        Schema::create('berkas_keluar_isi_berka', function (Blueprint $table) {
            $table->unsignedInteger('berkas_keluar_id');
            $table->foreign('berkas_keluar_id', 'berkas_keluar_id_fk_2165319')->references('id')->on('berkas_keluars')->onDelete('cascade');
            $table->unsignedInteger('isi_berka_id');
            $table->foreign('isi_berka_id', 'isi_berka_id_fk_2165319')->references('id')->on('isi_berkas')->onDelete('cascade');
        });
    }
}
