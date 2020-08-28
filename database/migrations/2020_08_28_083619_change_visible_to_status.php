<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeVisibleToStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('product_inventories', function (Blueprint $table) {
//            $table->renameColumn('visible', 'status');
//        });
        
       Schema::table('home_inventories', function (Blueprint $table) {
            $table->renameColumn('visible', 'status');
        });
        
        Schema::table('car_inventories', function (Blueprint $table) {
            $table->renameColumn('visible', 'status');
        });
        
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('visible');
        });
        
        Schema::table('groups', function (Blueprint $table) {
            $table->tinyInteger('status')->after('img_file_name');
        });
        
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->renameColumn('visible', 'status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
