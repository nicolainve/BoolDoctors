<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 150);
            $table->string('surname', 150);
            $table->string('slug', 150)->nullable();
            $table->string('address', 30);
            $table->text('CV')->nullable();
            $table->text('photo')->nullable();
            $table->string('phone',12)->nullable();
            $table->float('price', 6, 2)->nullable();
            $table->timestamps();

            // Relation One-To-One
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('infos');
    }
}
