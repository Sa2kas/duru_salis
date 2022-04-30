<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutsideDoorAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outside_door_accessories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('glass_packet')->default(false);
            $table->unsignedBigInteger('outside_door_accessory_type_id');
            $table->foreign('outside_door_accessory_type_id')->references('id')->on('outside_door_accessory_types');
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
        Schema::dropIfExists('outside_door_accessories');
    }
}
