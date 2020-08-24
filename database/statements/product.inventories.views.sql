/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Author:  pedro
 * Created: 24-ago-2020
 */

create view product_inventory_views as
select p.*, g.title as group_title, m.user_id from product_inventories p join groups g on p.group_id = g.id join members m on g.id = m.group_id where p.visible = 1 and p.deleted = 0 and g.visible = 'Visibile' and g.deleted = 0 and m.product_abled = 1;