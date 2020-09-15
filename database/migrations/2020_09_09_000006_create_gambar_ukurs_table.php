<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGambarUkursTable extends Migration
{
    public function up()
    {
        Schema::create('gambar_ukurs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
    }
}
