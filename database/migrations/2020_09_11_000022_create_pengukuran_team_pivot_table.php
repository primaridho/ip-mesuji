<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengukuranTeamPivotTable extends Migration
{
    public function up()
    {
        Schema::create('pengukuran_team', function (Blueprint $table) {
            $table->unsignedInteger('pengukuran_id');
            $table->foreign('pengukuran_id', 'pengukuran_id_fk_2164899')->references('id')->on('pengukurans')->onDelete('cascade');
            $table->unsignedInteger('team_id');
            $table->foreign('team_id', 'team_id_fk_2164899')->references('id')->on('teams')->onDelete('cascade');
        });
    }
}
