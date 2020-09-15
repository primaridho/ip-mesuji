<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBerkasMasuksTable extends Migration
{
    public function up()
    {
        Schema::table('berkas_masuks', function (Blueprint $table) {
            $table->unsignedInteger('penerima_masuk_id');
            $table->foreign('penerima_masuk_id', 'penerima_masuk_fk_2150530')->references('id')->on('teams');
            $table->unsignedInteger('desa_id');
            $table->foreign('desa_id', 'desa_fk_2164561')->references('id')->on('desas');
            $table->unsignedInteger('kecamatan_id');
            $table->foreign('kecamatan_id', 'kecamatan_fk_2164562')->references('id')->on('kecamatans');
        });
    }
}
