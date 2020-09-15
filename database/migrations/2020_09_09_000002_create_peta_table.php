<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetaTable extends Migration
{
    public function up()
    {
        Schema::create('peta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_peta');
            $table->string('no_lembar');
            $table->date('tahun');
            $table->longText('keterangan');
            $table->string('status_peta');
            $table->timestamps();
        });
    }
}
