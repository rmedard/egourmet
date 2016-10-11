<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('address_id')->unsigned()->index();
            $table->string('name');
            $table->string('mainphoto')->nullable();
            $table->string('tel', 25)->nullable();
            $table->string('website', 40)->nullable();
            $table->string('facebook')->nullable();
            $table->boolean('enabled')->default(1);
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
        Schema::drop('restos');
    }
}
