<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPetaTable extends Migration
{
    public function up()
    {
        Schema::table('peta', function (Blueprint $table) {
            $table->unsignedInteger('id_kecamatan_id');
            $table->foreign('id_kecamatan_id', 'id_kecamatan_fk_2149889')->references('id')->on('kecamatans');
            $table->unsignedInteger('id_desa_id');
            $table->foreign('id_desa_id', 'id_desa_fk_2149890')->references('id')->on('desas');
        });
    }
}
