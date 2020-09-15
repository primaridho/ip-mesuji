<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPengukuransTable extends Migration
{
    public function up()
    {
        Schema::table('pengukurans', function (Blueprint $table) {
            $table->unsignedInteger('id_berkas_id');
            $table->foreign('id_berkas_id', 'id_berkas_fk_2150820')->references('id')->on('berkas_masuks');
            $table->unsignedInteger('desa_id');
            $table->foreign('desa_id', 'desa_fk_2164721')->references('id')->on('desas');
            $table->unsignedInteger('kecamatan_id');
            $table->foreign('kecamatan_id', 'kecamatan_fk_2164722')->references('id')->on('kecamatans');
        });
    }
}
