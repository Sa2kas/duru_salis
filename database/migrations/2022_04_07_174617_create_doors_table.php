<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doors', function (Blueprint $table) {
            $table->id();
            $table->integer('length');
            $table->integer('width');
            $table->boolean('left')->default(true);
            $table->unsignedBigInteger('door_type_id');
            $table->foreign('door_type_id')->references('id')->on('door_types');
            $table->unsignedBigInteger('panel_id');
            $table->foreign('panel_id')->references('id')->on('panels');
            $table->unsignedBigInteger('decoration_id');
            $table->foreign('decoration_id')->references('id')->on('decorations');
            $table->string('main_lock');
            $table->string('safe_lock');
            $table->string('installation');
            $table->unsignedBigInteger('pattern_id')->nullable();
            $table->foreign('pattern_id')->references('id')->on('patterns');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->integer('quantity');
            $table->float('price');
            $table->string('customer');
            $table->string('phone');
            $table->string('email');
            $table->string('ordered')->default(false);
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
        Schema::dropIfExists('doors');
    }
}
