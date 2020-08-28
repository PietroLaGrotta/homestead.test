<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewCarInventoryViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement( 
            "create view car_inventory_views as
             select c.*, g.title as group_title, m.user_id 
             from car_inventories c 
             join groups g on c.group_id = g.id 
             join members m on g.id = m.group_id 
             where c.deleted = 0 and g.status = 1 and g.deleted = 0 and m.car_abled = 1"
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
            'drop view car_inventory_views'
        );
    }
}
