<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            
            $table->id();
            
            $table->unsignedBigInteger('howner_id');
            $table->unsignedBigInteger('subscription_id');
            $table->foreign('howner_id')->references('id')->on('users');
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
            
            $table->text('title');
            $table->text('description');
            $table->string('img_file_name', 256);
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
        Schema::dropIfExists('groups');
    }
}
