<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_inventories', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups');
            
            $table->string('registration_number', 128);
            $table->text('title');
            $table->text('description');
            $table->string('img_file_name', 256);
            $table->decimal('price', 8, 2);
            $table->string('registration_year');
            $table->decimal('kilometres', 8, 1);
            $table->boolean('visible');
            $table->boolean('deleted');
            
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
        Schema::dropIfExists('car_inventories');
    }
}
