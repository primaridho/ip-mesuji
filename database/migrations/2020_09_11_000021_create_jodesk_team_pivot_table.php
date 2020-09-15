<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJodeskTeamPivotTable extends Migration
{
    public function up()
    {
        Schema::create('jodesk_team', function (Blueprint $table) {
            $table->unsignedInteger('jodesk_id');
            $table->foreign('jodesk_id', 'jodesk_id_fk_2164735')->references('id')->on('jodesks')->onDelete('cascade');
            $table->unsignedInteger('team_id');
            $table->foreign('team_id', 'team_id_fk_2164735')->references('id')->on('teams')->onDelete('cascade');
        });
    }
}
