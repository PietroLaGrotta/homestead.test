<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeVisibleToStatusInViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement( 
            'alter view group_members_views as
             select m.*, u.name, u.email from members m join users u on m.user_id = u.id'
        );
                
        DB::statement( 
            "alter view product_inventory_views as
             select p.*, g.title as group_title, m.user_id 
             from product_inventories p 
             join groups g on p.group_id = g.id 
             join members m on g.id = m.group_id 
             where p.deleted = 0 and g.status = 1 and g.deleted = 0 and m.product_abled = 1"
        );
        
        DB::statement( 
            "alter view home_inventory_views as
             select h.*, g.title as group_title, m.user_id 
             from home_inventories h 
             join groups g on h.group_id = g.id 
             join members m on g.id = m.group_id 
             where h.deleted = 0 and g.status = 1 and g.deleted = 0 and m.home_abled = 1"
        ); 
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
