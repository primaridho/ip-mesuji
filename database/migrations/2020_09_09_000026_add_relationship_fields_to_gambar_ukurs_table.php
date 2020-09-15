<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToGambarUkursTable extends Migration
{
    public function up()
    {
        Schema::table('gambar_ukurs', function (Blueprint $table) {
            $table->unsignedInteger('id_pengukuran_id');
            $table->foreign('id_pengukuran_id', 'id_pengukuran_fk_2151270')->references('id')->on('pengukurans');
            $table->unsignedInteger('id_kecamatan_id');
            $table->foreign('id_kecamatan_id', 'id_kecamatan_fk_2151271')->references('id')->on('kecamatans');
            $table->unsignedInteger('id_desa_id');
            $table->foreign('id_desa_id', 'id_desa_fk_2151272')->references('id')->on('desas');
        });
    }
}
