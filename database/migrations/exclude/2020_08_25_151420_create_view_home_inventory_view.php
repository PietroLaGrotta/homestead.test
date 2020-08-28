<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewHomeInventoryView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement( 
            "create view home_inventory_views as
             select h.*, g.title as group_title, m.user_id 
             from home_inventories h 
             join groups g on h.group_id = g.id 
             join members m on g.id = m.group_id 
             where h.deleted = 0 and g.visible = 'Visibile' and g.deleted = 0 and m.home_abled = 1"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement( 
            'drop view home_inventory_views'
        );
    }
}
