/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Author:  pedro
 * Created: 24-ago-2020
 */

create view home_inventory_views as
select h.*, g.title as group_title, m.user_id from product_inventories h join groups g on h.group_id = g.id join members m on g.id = m.group_id where h.visible = 1 and h.deleted = 0 and g.visible = 'Visibile' and g.deleted = 0 and m.home_abled = 1;