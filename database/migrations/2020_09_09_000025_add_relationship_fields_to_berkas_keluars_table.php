<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBerkasKeluarsTable extends Migration
{
    public function up()
    {
        Schema::table('berkas_keluars', function (Blueprint $table) {
            $table->unsignedInteger('pemberi_keluar_id');
            $table->foreign('pemberi_keluar_id', 'pemberi_keluar_fk_2151030')->references('id')->on('teams');
            $table->unsignedInteger('berkasmasuk_id');
            $table->foreign('berkasmasuk_id', 'berkasmasuk_fk_2164546')->references('id')->on('berkas_masuks');
            $table->unsignedInteger('pengukuran_id')->nullable();
            $table->foreign('pengukuran_id', 'pengukuran_fk_2164689')->references('id')->on('pengukurans');
        });
    }
}
