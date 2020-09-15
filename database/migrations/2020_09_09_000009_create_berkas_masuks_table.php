<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasMasuksTable extends Migration
{
    public function up()
    {
        Schema::create('berkas_masuks', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('tgl_masuk');
            $table->string('petugas_loket');
            $table->string('no_berkas');
            $table->string('jenis_kegiatan');
            $table->string('nama_pemohon');
            $table->string('no_surattugas')->unique();
            $table->date('tgl_surattugas');
            $table->string('no_su')->nullable();
            $table->string('no_hak')->nullable();
            $table->longText('keterangan')->nullable();
            $table->timestamps();
        });
    }
}
