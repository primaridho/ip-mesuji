<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasKeluarsTable extends Migration
{
    public function up()
    {
        Schema::create('berkas_keluars', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('tgl_keluar');
            $table->string('penerima_keluar');
            $table->longText('keterangan')->nullable();
            $table->timestamps();
        });
    }
}
