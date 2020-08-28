<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_inventories', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups');
            
            $table->string('property_code', 128);
            $table->text('title');
            $table->text('description');
            $table->string('img_file_name', 256);
            $table->decimal('price', 8, 2);
            $table->text('address');
            $table->string('country', 256);
            $table->string('zip_code', 64);
            $table->point('position');
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
        Schema::dropIfExists('home_inventories');
    }
}
