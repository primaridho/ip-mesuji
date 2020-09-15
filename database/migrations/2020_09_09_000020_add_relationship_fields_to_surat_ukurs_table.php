<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSuratUkursTable extends Migration
{
    public function up()
    {
        Schema::table('surat_ukurs', function (Blueprint $table) {
            $table->unsignedInteger('id_kecamatan_id');
            $table->foreign('id_kecamatan_id', 'id_kecamatan_fk_2149860')->references('id')->on('kecamatans');
            $table->unsignedInteger('id_desa_id');
            $table->foreign('id_desa_id', 'id_desa_fk_2149861')->references('id')->on('desas');
        });
    }
}
