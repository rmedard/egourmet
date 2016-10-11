<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishRestoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_resto', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('dish_id')->unsigned()->index();
            $table->foreign('dish_id')->references('id')->on('dishes')->onDelete('cascade');

            $table->bigInteger('resto_id')->unsigned()->index();
            $table->foreign('resto_id')->references('id')->on('restos')->onDelete('cascade');

            $table->boolean('enabled');
            $table->integer('reviews_count')->default(0);
            $table->float('average_rate', 2, 1)->default(0.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dish_resto');
    }
}
