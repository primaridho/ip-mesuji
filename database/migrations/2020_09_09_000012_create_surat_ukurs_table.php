<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratUkursTable extends Migration
{
    public function up()
    {
        Schema::create('surat_ukurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_su');
            $table->date('tahun');
            $table->timestamps();
        });
    }
}
