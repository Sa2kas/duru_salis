<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_params', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_en');
            $table->boolean('glass_packet')->default(false);
            $table->float('price')->nullable();
            $table->unsignedBigInteger('additional_param_type_id');
            $table->foreign('additional_param_type_id')->references('id')->on('additional_param_types');
            $table->unsignedBigInteger('panel_id');
            $table->foreign('panel_id')->references('id')->on('panels');
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
        Schema::dropIfExists('additional_params');
    }
}
