/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  pedro
 * Created: 23-ago-2020
 */

create view group_members_views as
select m.*, u.name, u.email from members m join users u on m.user_id = u.id;


