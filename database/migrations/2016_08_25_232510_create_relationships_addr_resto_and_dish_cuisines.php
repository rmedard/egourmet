<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipsAddrRestoAndDishCuisines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restos', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses');
        });

        Schema::table('dishes', function (Blueprint $table) {
            $table->foreign('cuisine_id')->references('id')->on('cuisines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restos', function (Blueprint $table){
            $table->dropForeign('restos_address_id_foreign');
            $table->dropForeign('dishes_cuisine_id_foreign');
        });
    }
}
