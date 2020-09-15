<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDesasTable extends Migration
{
    public function up()
    {
        Schema::table('desas', function (Blueprint $table) {
            $table->unsignedInteger('id_kecamatan_id');
            $table->foreign('id_kecamatan_id', 'id_kecamatan_fk_2149853')->references('id')->on('kecamatans');
        });
    }
}
