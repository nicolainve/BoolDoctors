<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_vote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('info_id');
            $table->unsignedBigInteger('vote_id');
            // $table->timestamps();

            // Relation Many-To-Many
            $table->foreign('info_id')
                ->references('id')
                ->on('infos')
                ->onDelete('cascade');

            $table->foreign('vote_id')
                ->references('id')
                ->on('votes')
                ->onDelete('cascade');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_vote');
    }
}
