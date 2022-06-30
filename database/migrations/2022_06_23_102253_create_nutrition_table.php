<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('guide_id')->unsigned()->nullable(true);
             $table->string('name')->nullable();
            $table->longText('details')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();

            $table->foreign('guide_id')
                ->references('id')
                ->on('guide')
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
        Schema::dropIfExists('nutrition');
    }
}
