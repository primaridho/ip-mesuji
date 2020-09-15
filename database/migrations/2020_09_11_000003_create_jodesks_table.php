<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJodesksTable extends Migration
{
    public function up()
    {
        Schema::create('jodesks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_jodesk');
            $table->string('deskripsi');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }
}
