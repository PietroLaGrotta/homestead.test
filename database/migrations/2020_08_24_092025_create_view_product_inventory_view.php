<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewProductInventoryView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement( 
            "create view product_inventory_views as
             select p.*, g.title as group_title, m.user_id 
             from product_inventories p 
             join groups g on p.group_id = g.id 
             join members m on g.id = m.group_id 
             where p.deleted = 0 and g.visible = 'Visibile' and g.deleted = 0 and m.product_abled = 1"
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
            'drop view product_inventory_views'
        );
    }
}
