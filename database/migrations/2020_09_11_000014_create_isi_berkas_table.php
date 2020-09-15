<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsiBerkasTable extends Migration
{
    public function up()
    {
        Schema::create('isi_berkas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_isi');
            $table->timestamps();
        });
    }
}
