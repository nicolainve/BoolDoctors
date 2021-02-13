<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoSponsorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_sponsor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('info_id');
            $table->unsignedBigInteger('sponsor_id');
            $table->dateTime('expired_at', 0);
            $table->timestamps();


            //relazione many to many
            $table->foreign('info_id')
                ->references('id')
                ->on('infos')
                ->onDelete('cascade');

            $table->foreign('sponsor_id')
                ->references('id')
                ->on('sponsors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_sponsor');
    }
}
