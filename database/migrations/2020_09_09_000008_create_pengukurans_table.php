<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengukuransTable extends Migration
{
    public function up()
    {
        Schema::create('pengukurans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_gu')->unique();
            $table->datetime('tanggal_pengukuran');
            $table->longText('keterangan')->nullable();
            $table->string('no_su_baru')->nullable();
            $table->timestamps();
        });
    }
}
