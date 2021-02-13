<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoSpecializationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_specialization', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('info_id');
            $table->unsignedBigInteger('specialization_id');
            // $table->timestamps();

            // Relation Many-To-Many
            $table->foreign('info_id')
                ->references('id')
                ->on('infos')
                ->onDelete('cascade');

            $table->foreign('specialization_id')
                ->references('id')
                ->on('specializations')
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
        Schema::dropIfExists('info_specialization');
    }
}
