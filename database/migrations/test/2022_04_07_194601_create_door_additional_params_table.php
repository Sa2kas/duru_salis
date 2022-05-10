<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoorAdditionalParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('door_additional_params', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('door_id');
            $table->foreign('door_id')->references('id')->on('doors');
            $table->unsignedBigInteger('additional_param_id');
            $table->foreign('additional_param_id')->references('id')->on('additional_params');
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
        Schema::dropIfExists('door_additional_params');
    }
}
