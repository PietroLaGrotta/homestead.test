<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LngLatInsteadOfPoint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_inventories', function (Blueprint $table) {
            $table->dropColumn('position');
        });
        
        Schema::table('home_inventories', function (Blueprint $table) {
            $table->decimal('latitude', 23, 20)->after('zip_code');
        });
        
        Schema::table('home_inventories', function (Blueprint $table) {
            $table->decimal('longitude', 23, 20)->after('latitude');
        });
        
        DB::statement( 
            'drop view home_inventory_views'
        );
        
        DB::statement( 
            "create view home_inventory_views as
             select h.*, g.title as group_title, m.user_id 
             from home_inventories h 
             join groups g on h.group_id = g.id 
             join members m on g.id = m.group_id 
             where h.visible = 1 and h.deleted = 0 and g.visible = 'Visibile' and g.deleted = 0 and m.home_abled = 1"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_inventories', function (Blueprint $table) {
            $table->dropColumn('latitude');
        });
        
        Schema::table('home_inventories', function (Blueprint $table) {
            $table->dropColumn('longitude');
        });
        
        Schema::table('home_inventories', function (Blueprint $table) {
            $table->point('position', 23, 20)->after('zip_code');
        });
        
        DB::statement( 
            'drop view home_inventory_views'
        );
        
        DB::statement( 
            "create view home_inventory_views as
             select h.*, g.title as group_title, m.user_id 
             from home_inventories h 
             join groups g on h.group_id = g.id 
             join members m on g.id = m.group_id 
             where h.visible = 1 and h.deleted = 0 and g.visible = 'Visibile' and g.deleted = 0 and m.home_abled = 1"
        );
    }
}
